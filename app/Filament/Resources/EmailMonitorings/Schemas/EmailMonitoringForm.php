<?php

namespace App\Filament\Resources\EmailMonitorings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EmailMonitoringForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('email_requisition_id')
                    ->relationship('emailRequisition', 'id')
                    ->required(),
                TextInput::make('recipient_email')
                    ->email()
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('type')
                    ->required(),
                Textarea::make('error_message')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}