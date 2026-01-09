<?php

namespace App\Observers;

use App\Mail\RequisitionFulfilled;
use App\Mail\RequisitionSubmitted;
use App\Models\EmailMonitoring;
use App\Models\EmailRequisition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EmailRequisitionObserver
{
    public function creating(EmailRequisition $emailRequisition): void
    {
        if (Auth::check() && !$emailRequisition->requester_id) {
            $emailRequisition->requester_id = Auth::id();
        }
    }

    public function updated(EmailRequisition $emailRequisition): void
    {
        $originalStatus = $emailRequisition->getOriginal('status');
        $newStatus = $emailRequisition->status;

        if ($originalStatus !== $newStatus) {
            $this->handleStatusChange($emailRequisition, $newStatus);
        }
    }

    protected function handleStatusChange(EmailRequisition $requisition, string $status): void
    {
        $user = Auth::user();

        switch ($status) {
            case 'Submitted':
                if (!$requisition->requester_id) {
                    $requisition->updateQuietly(['requester_id' => $user?->id]);
                }
                $this->sendNotification($requisition, 'submitted');
                break;

            case 'Acknowledged':
                $requisition->updateQuietly(['dept_head_id' => $user?->id]);
                break;

            case 'Fulfilled':
                $requisition->updateQuietly(['itd_personnel_id' => $user?->id]);
                break;

            case 'Approved':
                $requisition->updateQuietly(['itd_manager_id' => $user?->id]);
                $this->sendNotification($requisition, 'finished');
                break;
        }
    }

    protected function sendNotification(EmailRequisition $requisition, string $type): void
    {
        $mailable = match ($type) {
            'submitted' => new RequisitionSubmitted($requisition),
            'finished' => new RequisitionFulfilled($requisition),
            default => null,
        };

        if (!$mailable) {
            return;
        }

        // We assume the user's email is where they want to receive notifications.
        // If it's a new email request, we might need a separate 'contact_email' field,
        // but for now we use the requester's account email.
        $recipient = $requisition->requester?->email ?? 'admin@example.com';

        try {
            Mail::to($recipient)->send($mailable);
            $this->logMonitoring($requisition, $recipient, $mailable->envelope()->subject, 'sent', $type);
        } catch (Throwable $e) {
            $this->logMonitoring($requisition, $recipient, $mailable->envelope()->subject, 'failed', $type, $e->getMessage());
        }
    }

    protected function logMonitoring(EmailRequisition $requisition, string $recipient, string $subject, string $status, string $type, ?string $error = null): void
    {
        EmailMonitoring::create([
            'email_requisition_id' => $requisition->id,
            'recipient_email' => $recipient,
            'subject' => $subject,
            'status' => $status,
            'type' => $type,
            'error_message' => $error,
        ]);
    }
}