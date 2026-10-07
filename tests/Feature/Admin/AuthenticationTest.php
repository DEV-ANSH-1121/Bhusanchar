<?php

use App\Models\Admin;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('renders the admin login page', function () {
    $this->get(route('admin.login'))
        ->assertSee('Sign in to manage BhuSanchar.', false);
});

it('prefixes admin routes with /app/cp instead of /admin', function () {
    expect(route('admin.login', absolute: false))->toBe('/app/cp/login')
        ->and(route('admin.dashboard', absolute: false))->toBe('/app/cp');
});

it('seeds the default admin user from configuration', function () {
    $this->seed(AdminUserSeeder::class);

    $admin = Admin::query()->where('email', config('admin.email'))->first();

    expect($admin)->not->toBeNull()
        ->and($admin->name)->toBe(config('admin.name'))
        ->and(Hash::check(config('admin.password'), $admin->password))->toBeTrue();
});

it('rejects invalid admin credentials', function () {
    Admin::factory()->create([
        'email' => 'admin@example.com',
    ]);

    $this->from(route('admin.login'))
        ->post(route('admin.login'), [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])
        ->assertRedirect(route('admin.login'))
        ->assertSessionHasErrors('email');

    $this->assertGuest('admin');
});

it('authenticates an admin and redirects to the dashboard', function () {
    $admin = Admin::factory()->create([
        'email' => 'admin@example.com',
    ]);

    $this->post(route('admin.login'), [
        'email' => 'admin@example.com',
        'password' => 'password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($admin, 'admin');
});

it('redirects authenticated admins away from the login page', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.login'))
        ->assertRedirect(route('admin.dashboard'));
});

it('logs the admin out and returns to the login page', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.logout'))
        ->assertRedirect(route('admin.login'));

    $this->assertGuest('admin');
});
