<?php

namespace App\Filament\Resources\EmailRequisitions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmailRequisitionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Draft' => 'gray',
                        'Submitted' => 'info',
                        'Acknowledged' => 'warning',
                        'Fulfilled' => 'primary',
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('requisition_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('request_type')
                    ->searchable(),
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('department')
                    ->searchable(),
                TextColumn::make('requester.name')
                    ->label('Requester')
                    ->searchable(),
                TextColumn::make('email_address')
                    ->label('Created Email')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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