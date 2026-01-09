<?php

namespace App\Filament\Resources\EmailMonitorings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmailMonitoringsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email_requisition_id')
                    ->label('Requisition ID')
                    ->sortable(),
                TextColumn::make('recipient_email')
                    ->searchable(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sent' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}