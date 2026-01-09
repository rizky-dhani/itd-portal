<?php

namespace App\Filament\Resources\EmailMonitorings\Pages;

use App\Filament\Resources\EmailMonitorings\EmailMonitoringResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmailMonitorings extends ListRecords
{
    protected static string $resource = EmailMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->after(function (\App\Models\EmailMonitoring $record) {
                    $requisition = $record->emailRequisition;
                    
                    $mailable = match ($record->type) {
                        'submitted' => new \App\Mail\RequisitionSubmitted($requisition),
                        'finished' => new \App\Mail\RequisitionFulfilled($requisition),
                        default => null,
                    };

                    if ($mailable) {
                        try {
                            \Illuminate\Support\Facades\Mail::to($record->recipient_email)->send($mailable);
                            $record->update(['status' => 'sent', 'error_message' => null]);
                        } catch (\Throwable $e) {
                            $record->update(['status' => 'failed', 'error_message' => $e->getMessage()]);
                        }
                    }
                }),
        ];
    }
}
