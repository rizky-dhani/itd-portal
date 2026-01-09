<?php

namespace App\Filament\Resources\EmailRequisitions\Pages;

use App\Filament\Resources\EmailRequisitions\EmailRequisitionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmailRequisition extends EditRecord
{
    protected static string $resource = EmailRequisitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
