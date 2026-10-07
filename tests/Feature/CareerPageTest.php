<?php

use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

/**
 * A small PDF that file-type detection accepts as application/pdf.
 */
function publicCareerResume(): UploadedFile
{
    $pdf = "%PDF-1.1\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n2 0 obj<</Type/Pages/Count 0/Kids[]>>endobj\ntrailer<</Root 1 0 R>>\n%%EOF";

    return UploadedFile::fake()->createWithContent('resume.pdf', $pdf);
}

it('shows open jobs as bullet lists and hides closed jobs', function () {
    $this->travelTo('2026-09-24 12:00:00');

    Career::factory()->create([
        'job_title' => 'Closed Role',
        'eligible_criteria' => ['Should stay hidden'],
        'last_application_date' => '2026-09-23',
    ]);
    Career::factory()->create([
        'job_title' => 'Block Officer',
        'job_description' => 'Support regional execution.',
        'eligible_criteria' => ['Graduate in agriculture'],
        'key_responsibilities' => ['Coordinate stock points'],
        'salary' => '₹25,000 – ₹40,000',
        'location' => 'Patna',
        'last_application_date' => '2026-09-24',
    ]);

    $this->get(route('careers'))
        ->assertSee('Build Your Career. Build Rural India.', false)
        ->assertSee('Block Officer', false)
        ->assertSee('Graduate in agriculture', false)
        ->assertSee('Coordinate stock points', false)
        ->assertDontSee('Closed Role', false)
        ->assertDontSee('Should stay hidden', false);
});

it('escapes job criteria on the public careers page', function () {
    Career::factory()->create([
        'job_title' => 'Safe Role',
        'eligible_criteria' => ["<script>alert('xss')</script>"],
        'key_responsibilities' => ['Visit farms'],
        'last_application_date' => now()->addDay()->toDateString(),
    ]);

    $this->get(route('careers'))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false);
});

it('stores a public career application for an open job', function () {
    Storage::fake(config('filesystems.default'));
    $this->travelTo('2026-09-24 12:00:00');

    $career = Career::factory()->create([
        'last_application_date' => '2026-10-01',
    ]);

    $this->from(route('careers'))
        ->post(route('careers.apply'), [
            'career_id' => $career->id,
            'name' => 'Neha Sharma',
            'email' => 'neha@example.com',
            'mobile' => '9801892639',
            'resume' => publicCareerResume(),
            'resume_path' => 'ignored/secret.pdf',
        ])
        ->assertRedirect(route('careers'))
        ->assertSessionHas('status', 'career-application-submitted');

    $application = CareerApplication::query()->first();

    expect($application)->not->toBeNull()
        ->and($application->career_id)->toBe($career->id)
        ->and($application->resume_path)->not->toBe('ignored/secret.pdf')
        ->and($application->resume_disk)->toBe(config('filesystems.default'));

    Storage::disk($application->resume_disk)->assertExists($application->resume_path);
});

it('rejects an application for a job that is past its last date', function () {
    Storage::fake(config('filesystems.default'));
    $this->travelTo('2026-09-24 12:00:00');

    $career = Career::factory()->create([
        'last_application_date' => '2026-09-23',
    ]);

    $this->from(route('careers'))
        ->post(route('careers.apply'), [
            'career_id' => $career->id,
            'name' => 'Neha Sharma',
            'email' => 'neha@example.com',
            'mobile' => '9801892639',
            'resume' => publicCareerResume(),
        ])
        ->assertRedirect(route('careers'))
        ->assertSessionHasErrors('career_id');

    $this->assertDatabaseCount('career_applications', 0);
});
