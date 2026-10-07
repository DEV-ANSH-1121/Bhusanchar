<?php

use App\Enums\InquiryType;
use App\Models\Admin;
use App\Models\ContactEnquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests away from contact enquiry endpoints', function (string $method, string $uri) {
    $this->{$method}($uri)->assertRedirect(route('admin.login'));
})->with([
    'index' => ['get', '/app/cp/enquiries/contacts'],
    'create' => ['get', '/app/cp/enquiries/contacts/create'],
    'store' => ['post', '/app/cp/enquiries/contacts'],
]);

it('lists contact enquiries and escapes the applicant name', function () {
    $admin = Admin::factory()->create();
    ContactEnquiry::factory()->create([
        'name' => "<script>alert('xss')</script>",
        'inquiry_type' => InquiryType::GeneralEnquiry,
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.contact-enquiries.index'))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false)
        ->assertSee('General Enquiry', false)
        ->assertSee(route('admin.farmer-help-cards.index'), false)
        ->assertSee(route('admin.careers.index'), false);
});

it('creates a contact enquiry', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->post(route('admin.contact-enquiries.store'), [
            'name' => 'Ravi Kumar',
            'email' => 'ravi@example.com',
            'mobile' => '9801892639',
            'product_interested' => 'Soil Mix',
            'state' => 'Bihar',
            'district' => 'Patna',
            'block' => 'Danapur',
            'inquiry_type' => InquiryType::ProductEnquiry->value,
            'message' => 'I want a price for soil mix.',
            'inquiry_type_label' => 'ignored',
        ])
        ->assertRedirect(route('admin.contact-enquiries.index'))
        ->assertSessionHas('status', 'contact-enquiry-created');

    $enquiry = ContactEnquiry::query()->first();

    expect($enquiry)->not->toBeNull()
        ->and($enquiry->name)->toBe('Ravi Kumar')
        ->and($enquiry->inquiry_type)->toBe(InquiryType::ProductEnquiry)
        ->and($enquiry->message)->toBe('I want a price for soil mix.');
});

it('rejects a contact enquiry when required fields are missing', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.contact-enquiries.create'))
        ->post(route('admin.contact-enquiries.store'), [])
        ->assertRedirect(route('admin.contact-enquiries.create'))
        ->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'email' => 'The email field is required.',
            'mobile' => 'The mobile field is required.',
            'inquiry_type' => 'The inquiry type field is required.',
            'message' => 'The message field is required.',
        ]);

    $this->assertDatabaseCount('contact_enquiries', 0);
});

it('rejects an unknown inquiry type', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.contact-enquiries.create'))
        ->post(route('admin.contact-enquiries.store'), [
            'name' => 'Ravi Kumar',
            'email' => 'ravi@example.com',
            'mobile' => '9801892639',
            'inquiry_type' => 99,
            'message' => 'Hello',
        ])
        ->assertRedirect(route('admin.contact-enquiries.create'))
        ->assertSessionHasErrors([
            'inquiry_type' => 'The selected inquiry type is invalid.',
        ]);

    $this->assertDatabaseCount('contact_enquiries', 0);
});

it('updates a contact enquiry', function () {
    $admin = Admin::factory()->create();
    $enquiry = ContactEnquiry::factory()->create([
        'name' => 'Old Name',
        'inquiry_type' => InquiryType::GeneralEnquiry,
    ]);

    $this->actingAs($admin, 'admin')
        ->put(route('admin.contact-enquiries.update', $enquiry), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'mobile' => '9800000000',
            'inquiry_type' => InquiryType::Technology->value,
            'message' => 'Updated message.',
        ])
        ->assertRedirect(route('admin.contact-enquiries.index'))
        ->assertSessionHas('status', 'contact-enquiry-updated');

    expect($enquiry->refresh()->name)->toBe('Updated Name')
        ->and($enquiry->inquiry_type)->toBe(InquiryType::Technology);
});

it('renders the contact enquiry form', function () {
    $admin = Admin::factory()->create();

    $this->actingAs($admin, 'admin')
        ->get(route('admin.contact-enquiries.create'))
        ->assertSee('Inquiry type', false)
        ->assertSee('Farmer Support', false)
        ->assertSee('General Enquiry', false);
});

it('deletes a contact enquiry', function () {
    $admin = Admin::factory()->create();
    $enquiry = ContactEnquiry::factory()->create();

    $this->actingAs($admin, 'admin')
        ->delete(route('admin.contact-enquiries.destroy', $enquiry))
        ->assertRedirect(route('admin.contact-enquiries.index'))
        ->assertSessionHas('status', 'contact-enquiry-deleted');

    $this->assertModelMissing($enquiry);
});
