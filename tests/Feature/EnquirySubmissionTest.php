<?php

use App\Enums\InquiryType;
use App\Models\ContactEnquiry;
use App\Models\FarmerHelpCard;
use App\Models\StockPointApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores a contact message from the public form', function () {
    $this->from(route('contact'))
        ->post(route('contact.store'), [
            'name' => 'Ravi Kumar',
            'email' => 'ravi@example.com',
            'mobile' => '9801892639',
            'product_interested' => 'Soil Mix',
            'state' => 'Bihar',
            'district' => 'Patna',
            'block' => 'Danapur',
            'inquiry_type' => InquiryType::ProductEnquiry->value,
            'message' => 'Please share the price.',
        ])
        ->assertRedirect(route('contact'))
        ->assertSessionHas('status', 'contact-submitted');

    $enquiry = ContactEnquiry::query()->first();

    expect($enquiry)->not->toBeNull()
        ->and($enquiry->inquiry_type)->toBe(InquiryType::ProductEnquiry)
        ->and($enquiry->message)->toBe('Please share the price.');
});

it('rejects a public contact message when required fields are missing', function () {
    $this->from(route('contact'))
        ->post(route('contact.store'), [])
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'email' => 'The email field is required.',
            'message' => 'The message field is required.',
        ]);

    $this->assertDatabaseCount('contact_enquiries', 0);
});

it('stores a farmer help card application from the public form', function () {
    $this->from(route('services.farmer-help-card'))
        ->post(route('services.farmer-help-card.store'), [
            'name' => 'Sita Devi',
            'email' => 'sita@example.com',
            'mobile' => '9801892639',
            'state' => 'Bihar',
            'district' => 'Gaya',
            'village' => 'Manpur',
            'preferred_bhusanchar_point' => 'Gaya Point',
            'consent' => '1',
        ])
        ->assertRedirect(route('services.farmer-help-card'))
        ->assertSessionHas('status', 'farmer-help-card-submitted');

    $this->assertDatabaseHas('farmer_help_cards', [
        'email' => 'sita@example.com',
        'preferred_bhusanchar_point' => 'Gaya Point',
    ]);

    expect(FarmerHelpCard::query()->count())->toBe(1);
});

it('rejects a farmer help card application without consent', function () {
    $this->from(route('services.farmer-help-card'))
        ->post(route('services.farmer-help-card.store'), [
            'name' => 'Sita Devi',
            'email' => 'sita@example.com',
            'mobile' => '9801892639',
            'state' => 'Bihar',
            'district' => 'Gaya',
        ])
        ->assertRedirect(route('services.farmer-help-card'))
        ->assertSessionHasErrors([
            'consent' => 'The consent field must be accepted.',
        ]);

    $this->assertDatabaseCount('farmer_help_cards', 0);
});

it('stores a stock point application from the partner form', function () {
    $this->from(route('partner.index'))
        ->post(route('partner.store'), [
            'applicant_name' => 'Amit Singh',
            'business_name' => 'Singh Agri Store',
            'email' => 'amit@example.com',
            'mobile' => '9801892639',
            'state' => 'Bihar',
            'district' => 'Patna',
            'panchayat' => 'Kankarbagh',
            'business_address' => 'Near Kankarbagh, Patna',
        ])
        ->assertRedirect(route('partner.index'))
        ->assertSessionHas('status', 'stock-point-submitted');

    expect(StockPointApplication::query()->where('business_name', 'Singh Agri Store')->exists())->toBeTrue();
});
