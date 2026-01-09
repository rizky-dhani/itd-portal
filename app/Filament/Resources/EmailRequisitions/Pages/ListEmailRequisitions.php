<?php

namespace App\Filament\Resources\EmailRequisitions\Pages;

use App\Filament\Resources\EmailRequisitions\EmailRequisitionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmailRequisitions extends ListRecords
{
    protected static string $resource = EmailRequisitionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
