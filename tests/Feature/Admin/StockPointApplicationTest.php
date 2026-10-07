<?php

use App\Models\Admin;
use App\Models\StockPointApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests away from stock point endpoints', function () {
    $this->get('/app/cp/enquiries/stock-points')->assertRedirect(route('admin.login'));
});

it('creates a stock point application', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.stock-point-applications.store'), [
            'applicant_name' => 'Amit Singh',
            'business_name' => 'Singh Agri Store',
            'email' => 'amit@example.com',
            'mobile' => '9801892639',
            'state' => 'Bihar',
            'district' => 'Patna',
            'block' => 'Danapur',
            'panchayat' => 'Kankarbagh',
            'business_address' => 'Near Kankarbagh, Patna',
        ])
        ->assertRedirect(route('admin.stock-point-applications.index'))
        ->assertSessionHas('status', 'stock-point-application-created');

    $this->assertDatabaseHas('stock_point_applications', [
        'business_name' => 'Singh Agri Store',
        'business_address' => 'Near Kankarbagh, Patna',
    ]);
});

it('rejects a stock point application when the business name is missing', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.stock-point-applications.create'))
        ->post(route('admin.stock-point-applications.store'), [
            'applicant_name' => 'Amit Singh',
            'email' => 'amit@example.com',
            'mobile' => '9801892639',
        ])
        ->assertRedirect(route('admin.stock-point-applications.create'))
        ->assertSessionHasErrors([
            'business_name' => 'The business name field is required.',
        ]);

    $this->assertDatabaseCount('stock_point_applications', 0);
});

it('deletes a stock point application', function () {
    $admin = Admin::factory()->create();
    $application = StockPointApplication::factory()->create();

    $this->actingAs($admin, 'admin')
        ->delete(route('admin.stock-point-applications.destroy', $application))
        ->assertRedirect(route('admin.stock-point-applications.index'))
        ->assertSessionHas('status', 'stock-point-application-deleted');

    $this->assertModelMissing($application);
});
