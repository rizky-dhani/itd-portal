<?php

namespace App\Filament\Resources\EmailMonitorings;

use App\Filament\Resources\EmailMonitorings\Pages\CreateEmailMonitoring;
use App\Filament\Resources\EmailMonitorings\Pages\EditEmailMonitoring;
use App\Filament\Resources\EmailMonitorings\Pages\ListEmailMonitorings;
use App\Filament\Resources\EmailMonitorings\Schemas\EmailMonitoringForm;
use App\Filament\Resources\EmailMonitorings\Tables\EmailMonitoringsTable;
use App\Models\EmailMonitoring;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmailMonitoringResource extends Resource
{
    protected static ?string $model = EmailMonitoring::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EmailMonitoringForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmailMonitoringsTable::configure($table);
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
            'index' => ListEmailMonitorings::route('/'),
            'create' => CreateEmailMonitoring::route('/create'),
            'edit' => EditEmailMonitoring::route('/{record}/edit'),
        ];
    }
}
