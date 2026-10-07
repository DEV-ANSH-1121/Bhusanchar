<?php

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests away from the profile page', function () {
    $this->get(route('admin.profile.edit'))
        ->assertRedirect(route('admin.login'));
});

it('renders the profile and password forms', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.profile.edit'))
        ->assertSee('Profile information', false)
        ->assertSee('Change password', false);
});

it('updates the authenticated admin profile', function () {
    $admin = Admin::factory()->create([
        'name' => 'Old Name',
        'email' => 'old@example.com',
    ]);

    $this->actingAs($admin, 'admin')
        ->from(route('admin.profile.edit'))
        ->patch(route('admin.profile.update'), [
            'name' => 'New Name',
            'email' => 'new@example.com',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHas('status', 'profile-updated');

    $admin->refresh();

    expect($admin->name)->toBe('New Name')
        ->and($admin->email)->toBe('new@example.com');
});

it('rejects a profile update when required fields are missing', function () {
    $admin = Admin::factory()->create([
        'name' => 'Keep Name',
        'email' => 'keep@example.com',
    ]);

    $this->actingAs($admin, 'admin')
        ->from(route('admin.profile.edit'))
        ->patch(route('admin.profile.update'), [])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHasErrors(['name', 'email']);

    $admin->refresh();

    expect($admin->name)->toBe('Keep Name')
        ->and($admin->email)->toBe('keep@example.com');
});

it('rejects an email that already belongs to another admin', function () {
    Admin::factory()->create([
        'email' => 'taken@example.com',
    ]);

    $admin = Admin::factory()->create([
        'email' => 'mine@example.com',
    ]);

    $this->actingAs($admin, 'admin')
        ->from(route('admin.profile.edit'))
        ->patch(route('admin.profile.update'), [
            'name' => $admin->name,
            'email' => 'taken@example.com',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHasErrors('email');

    expect($admin->refresh()->email)->toBe('mine@example.com');
});

it('updates the authenticated admin password', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.profile.edit'))
        ->put(route('admin.password.update'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHas('status', 'password-updated');

    expect(Hash::check('new-password', $admin->refresh()->password))->toBeTrue();
});

it('rejects a password change when the current password is wrong', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.profile.edit'))
        ->put(route('admin.password.update'), [
            'current_password' => 'not-the-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHasErrors('current_password');

    expect(Hash::check('password', $admin->refresh()->password))->toBeTrue();
});

it('rejects a password change when confirmation does not match', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.profile.edit'))
        ->put(route('admin.password.update'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'different-password',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHasErrors('password');

    expect(Hash::check('password', $admin->refresh()->password))->toBeTrue();
});
