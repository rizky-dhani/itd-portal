<?php

namespace App\Filament\Resources\EmailRequisitions;

use App\Filament\Resources\EmailRequisitions\Pages\CreateEmailRequisition;
use App\Filament\Resources\EmailRequisitions\Pages\EditEmailRequisition;
use App\Filament\Resources\EmailRequisitions\Pages\ListEmailRequisitions;
use App\Filament\Resources\EmailRequisitions\Schemas\EmailRequisitionForm;
use App\Filament\Resources\EmailRequisitions\Tables\EmailRequisitionsTable;
use App\Models\EmailRequisition;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmailRequisitionResource extends Resource
{
    protected static ?string $model = EmailRequisition::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EmailRequisitionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmailRequisitionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmailRequisitions::route('/'),
            'create' => CreateEmailRequisition::route('/create'),
            'edit' => EditEmailRequisition::route('/{record}/edit'),
        ];
    }
}
