<?php

namespace App\Actions\Admin;

use App\Mail\EnquiryAdminMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class UpdateEnquiryStatus
{
    /**
     * Save the follow-up and optionally email it to the applicant.
     *
     * @return 'saved'|'emailed'|'email-failed'
     */
    public function handle(Model $enquiry, int $status, ?string $adminMessage, bool $sendEmail, string $recipientName, string $topic): string
    {
        $enquiry->update([
            'status' => $status,
            'admin_message' => $adminMessage,
        ]);

        if (! $sendEmail) {
            return 'saved';
        }

        try {
            Mail::to($enquiry->getAttribute('email'))->send(new EnquiryAdminMessage(
                $recipientName,
                $topic,
                (string) $adminMessage,
            ));
        } catch (TransportExceptionInterface $exception) {
            report($exception);

            return 'email-failed';
        }

        return 'emailed';
    }
}
