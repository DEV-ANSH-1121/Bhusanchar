<?php

use App\Mail\EnquiryAdminMessage;
use App\Models\Admin;
use App\Models\CareerApplication;
use App\Models\ContactEnquiry;
use App\Models\FarmerHelpCard;
use App\Models\StockPointApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('redirects guests away from enquiry detail pages', function (string $model, string $showRoute, string $statusRoute) {
    $record = $model::factory()->create();

    $this->get(route($showRoute, $record))->assertRedirect(route('admin.login'));
    $this->patch(route($statusRoute, $record), [])->assertRedirect(route('admin.login'));
})->with([
    'contact' => [ContactEnquiry::class, 'admin.contact-enquiries.show', 'admin.contact-enquiries.status'],
    'farmer help card' => [FarmerHelpCard::class, 'admin.farmer-help-cards.show', 'admin.farmer-help-cards.status'],
    'stock point' => [StockPointApplication::class, 'admin.stock-point-applications.show', 'admin.stock-point-applications.status'],
    'career application' => [CareerApplication::class, 'admin.career-applications.show', 'admin.career-applications.status'],
]);

it('shows enquiry details and hides the long message from the index', function () {
    $admin = Admin::factory()->create();
    $enquiry = ContactEnquiry::factory()->create([
        'name' => 'Ravi Kumar',
        'message' => 'Please share the soil mix price for Danapur.',
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.contact-enquiries.index'))
        ->assertSee('Ravi Kumar', false)
        ->assertSee('New', false)
        ->assertSee('View', false)
        ->assertDontSee('Please share the soil mix price for Danapur.', false);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.contact-enquiries.show', $enquiry))
        ->assertSee('Please share the soil mix price for Danapur.', false)
        ->assertSee('Follow up', false)
        ->assertSee('Email this message to the applicant', false);
});

it('escapes enquiry messages on the detail page', function () {
    $admin = Admin::factory()->create();
    $enquiry = ContactEnquiry::factory()->create([
        'message' => "<script>alert('xss')</script>",
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.contact-enquiries.show', $enquiry))
        ->assertSee('&lt;script&gt;', false)
        ->assertDontSee("<script>alert('xss')</script>", false);
});

it('updates the status without sending mail when email is not requested', function () {
    Mail::fake();

    $admin = Admin::factory()->create();
    $enquiry = ContactEnquiry::factory()->create([
        'status' => ContactEnquiry::STATUS_NEW,
    ]);

    $this->actingAs($admin, 'admin')
        ->from(route('admin.contact-enquiries.show', $enquiry))
        ->patch(route('admin.contact-enquiries.status', $enquiry), [
            'status' => ContactEnquiry::STATUS_IN_PROGRESS,
            'admin_message' => 'We will call you tomorrow.',
        ])
        ->assertRedirect(route('admin.contact-enquiries.show', $enquiry))
        ->assertSessionHas('status', 'enquiry-status-saved');

    expect($enquiry->refresh()->status)->toBe(ContactEnquiry::STATUS_IN_PROGRESS)
        ->and($enquiry->admin_message)->toBe('We will call you tomorrow.');

    Mail::assertNothingSent();
});

it('emails the admin message when the option is checked', function (string $model, string $showRoute, string $statusRoute, string $nameAttribute, string $topic) {
    Mail::fake();

    $admin = Admin::factory()->create();
    $record = $model::factory()->create([
        'email' => 'applicant@example.com',
        $nameAttribute => 'Ravi Kumar',
    ]);

    $this->actingAs($admin, 'admin')
        ->patch(route($statusRoute, $record), [
            'status' => $model::STATUS_CLOSED,
            'admin_message' => 'Your request is closed.',
            'send_email' => '1',
        ])
        ->assertRedirect(route($showRoute, $record))
        ->assertSessionHas('status', 'enquiry-status-emailed');

    expect($record->refresh()->status)->toBe($model::STATUS_CLOSED);

    Mail::assertSent(EnquiryAdminMessage::class, function (EnquiryAdminMessage $mail) use ($topic) {
        return $mail->hasTo('applicant@example.com')
            && $mail->topic === $topic
            && $mail->adminMessage === 'Your request is closed.';
    });
})->with([
    'contact' => [ContactEnquiry::class, 'admin.contact-enquiries.show', 'admin.contact-enquiries.status', 'name', 'your contact enquiry'],
    'farmer help card' => [FarmerHelpCard::class, 'admin.farmer-help-cards.show', 'admin.farmer-help-cards.status', 'name', 'your farmer help card application'],
    'stock point' => [StockPointApplication::class, 'admin.stock-point-applications.show', 'admin.stock-point-applications.status', 'applicant_name', 'your stock point application'],
    'career application' => [CareerApplication::class, 'admin.career-applications.show', 'admin.career-applications.status', 'name', 'your career application'],
]);

it('requires a message before emailing the applicant', function () {
    Mail::fake();

    $admin = Admin::factory()->create();
    $enquiry = ContactEnquiry::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.contact-enquiries.show', $enquiry))
        ->patch(route('admin.contact-enquiries.status', $enquiry), [
            'status' => ContactEnquiry::STATUS_IN_PROGRESS,
            'send_email' => '1',
        ])
        ->assertRedirect(route('admin.contact-enquiries.show', $enquiry))
        ->assertSessionHasErrors([
            'admin_message' => 'The message field is required when email option is true.',
        ]);

    expect($enquiry->refresh()->status)->toBe(ContactEnquiry::STATUS_NEW);
    Mail::assertNothingSent();
});

it('rejects an unknown enquiry status', function () {
    $admin = Admin::factory()->create();
    $enquiry = ContactEnquiry::factory()->create();

    $this->actingAs($admin, 'admin')
        ->from(route('admin.contact-enquiries.show', $enquiry))
        ->patch(route('admin.contact-enquiries.status', $enquiry), [
            'status' => 99,
            'admin_message' => 'Hello',
        ])
        ->assertRedirect(route('admin.contact-enquiries.show', $enquiry))
        ->assertSessionHasErrors([
            'status' => 'The selected status is invalid.',
        ]);

    expect($enquiry->refresh()->status)->toBe(ContactEnquiry::STATUS_NEW);
});

it('includes the admin message in the enquiry email', function () {
    $mail = new EnquiryAdminMessage('Ravi Kumar', 'your contact enquiry', 'We will call you tomorrow.');

    $mail->assertHasSubject('Update on your contact enquiry');
    $mail->assertSeeInHtml('Ravi Kumar');
    $mail->assertSeeInHtml('We will call you tomorrow.');
    $mail->assertSeeInText('We will call you tomorrow.');
});
