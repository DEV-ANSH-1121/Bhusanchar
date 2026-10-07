<?php

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests to the admin login page', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('admin.login'));
});

it('renders the dashboard for an authenticated admin', function () {
    $admin = Admin::factory()->create([
        'name' => 'Priya Sharma',
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.dashboard'))
        ->assertSee('Welcome back', false)
        ->assertSee('Priya Sharma', false);
});

it('escapes the admin name on the dashboard', function () {
    $admin = Admin::factory()->create([
        'name' => "<script>alert('xss')</script>",
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.dashboard'))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false);
});
