<?php

namespace App\Filament\Resources\EmailMonitorings\Pages;

use App\Filament\Resources\EmailMonitorings\EmailMonitoringResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmailMonitoring extends EditRecord
{
    protected static string $resource = EmailMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
