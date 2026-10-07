<?php

use App\Models\Admin;
use App\Models\FarmerHelpCard;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests away from farmer help card endpoints', function () {
    $this->get('/app/cp/enquiries/farmer-help-cards')->assertRedirect(route('admin.login'));
});

it('creates a farmer help card application', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.farmer-help-cards.store'), [
            'name' => 'Sita Devi',
            'email' => 'sita@example.com',
            'mobile' => '9801892639',
            'state' => 'Bihar',
            'district' => 'Gaya',
            'block' => 'Gaya Block',
            'village' => 'Manpur',
            'preferred_bhusanchar_point' => 'Gaya Stock Point',
        ])
        ->assertRedirect(route('admin.farmer-help-cards.index'))
        ->assertSessionHas('status', 'farmer-help-card-created');

    $this->assertDatabaseHas('farmer_help_cards', [
        'name' => 'Sita Devi',
        'preferred_bhusanchar_point' => 'Gaya Stock Point',
    ]);
});

it('rejects a farmer help card when the email is missing', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.farmer-help-cards.create'))
        ->post(route('admin.farmer-help-cards.store'), [
            'name' => 'Sita Devi',
            'mobile' => '9801892639',
            'state' => 'Bihar',
            'district' => 'Gaya',
        ])
        ->assertRedirect(route('admin.farmer-help-cards.create'))
        ->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);

    $this->assertDatabaseCount('farmer_help_cards', 0);
});

it('escapes farmer names on the listing page', function () {
    $admin = Admin::factory()->create();
    FarmerHelpCard::factory()->create([
        'name' => "<script>alert('xss')</script>",
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.farmer-help-cards.index'))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false);
});

it('deletes a farmer help card application', function () {
    $admin = Admin::factory()->create();
    $application = FarmerHelpCard::factory()->create();

    $this->actingAs($admin, 'admin')
        ->delete(route('admin.farmer-help-cards.destroy', $application))
        ->assertRedirect(route('admin.farmer-help-cards.index'))
        ->assertSessionHas('status', 'farmer-help-card-deleted');

    $this->assertModelMissing($application);
});
