<?php

use App\Models\Admin;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests away from career endpoints', function () {
    $this->get('/app/cp/careers')->assertRedirect(route('admin.login'));
});

it('creates a job opening with bullet points', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.careers.store'), [
            'job_title' => 'Block Officer',
            'job_description' => 'Support regional execution and field coordination.',
            'eligible_criteria' => ['Graduate in agriculture', '  ', 'Two years of field work'],
            'key_responsibilities' => ['Coordinate stock points', 'Train panchayat officers'],
            'salary' => '₹25,000 – ₹40,000',
            'location' => 'Patna',
            'last_application_date' => '2026-12-31',
        ])
        ->assertRedirect(route('admin.careers.index'))
        ->assertSessionHas('status', 'career-created');

    $career = Career::query()->first();

    expect($career)->not->toBeNull()
        ->and($career->job_title)->toBe('Block Officer')
        ->and($career->eligible_criteria)->toBe(['Graduate in agriculture', 'Two years of field work'])
        ->and($career->key_responsibilities)->toBe(['Coordinate stock points', 'Train panchayat officers'])
        ->and($career->last_application_date->toDateString())->toBe('2026-12-31');
});

it('rejects a job opening when eligible criteria are blank', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.careers.create'))
        ->post(route('admin.careers.store'), [
            'job_title' => 'Block Officer',
            'job_description' => 'Support regional execution.',
            'eligible_criteria' => ['', '   '],
            'key_responsibilities' => ['Coordinate stock points'],
            'salary' => '₹25,000',
            'location' => 'Patna',
            'last_application_date' => '2026-12-31',
        ])
        ->assertRedirect(route('admin.careers.create'))
        ->assertSessionHasErrors([
            'eligible_criteria' => 'The eligible criteria field is required.',
        ]);

    $this->assertDatabaseCount('careers', 0);
});

it('rejects a job opening when the title is missing', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.careers.create'))
        ->post(route('admin.careers.store'), [])
        ->assertRedirect(route('admin.careers.create'))
        ->assertSessionHasErrors([
            'job_title' => 'The job title field is required.',
            'job_description' => 'The job description field is required.',
            'salary' => 'The salary field is required.',
            'location' => 'The location field is required.',
            'last_application_date' => 'The last application date field is required.',
        ]);
});

it('updates bullet points on a job opening', function () {
    $admin = Admin::factory()->create();
    $career = Career::factory()->create([
        'job_title' => 'Old Title',
        'eligible_criteria' => ['Old point'],
        'key_responsibilities' => ['Old duty'],
    ]);

    $this->actingAs($admin, 'admin')
        ->put(route('admin.careers.update', $career), [
            'job_title' => 'District Officer',
            'job_description' => 'Lead the district network.',
            'eligible_criteria' => ['MBA or agriculture degree'],
            'key_responsibilities' => ['Hire block officers', 'Review stock points'],
            'salary' => '₹50,000',
            'location' => 'Ranchi',
            'last_application_date' => '2026-11-15',
        ])
        ->assertRedirect(route('admin.careers.index'))
        ->assertSessionHas('status', 'career-updated');

    expect($career->refresh()->eligible_criteria)->toBe(['MBA or agriculture degree'])
        ->and($career->key_responsibilities)->toBe(['Hire block officers', 'Review stock points'])
        ->and($career->job_title)->toBe('District Officer');
});

it('renders the job form with repeatable bullet points', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.careers.create'))
        ->assertSee('Eligible criteria', false)
        ->assertSee('Key responsibilities', false)
        ->assertSee('Add point', false)
        ->assertSee('name="eligible_criteria[]"', false)
        ->assertSee('name="key_responsibilities[]"', false);
});

it('deletes a job opening that has no applications', function () {
    $admin = Admin::factory()->create();
    $career = Career::factory()->create();

    $this->actingAs($admin, 'admin')
        ->delete(route('admin.careers.destroy', $career))
        ->assertRedirect(route('admin.careers.index'))
        ->assertSessionHas('status', 'career-deleted');

    $this->assertModelMissing($career);
});

it('keeps a job opening that still has applications', function () {
    $admin = Admin::factory()->create();
    $career = Career::factory()->create();
    CareerApplication::factory()->create(['career_id' => $career->id]);

    $this->actingAs($admin, 'admin')
        ->from(route('admin.careers.index'))
        ->delete(route('admin.careers.destroy', $career))
        ->assertRedirect(route('admin.careers.index'))
        ->assertSessionHas('status', 'career-has-applications');

    $this->assertModelExists($career);
});

it('escapes job titles on the listing page', function () {
    $admin = Admin::factory()->create();
    Career::factory()->create([
        'job_title' => "<script>alert('xss')</script>",
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.careers.index'))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false);
});
