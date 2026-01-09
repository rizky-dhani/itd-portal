<?php

namespace App\Filament\Resources\EmailRequisitions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class EmailRequisitionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Staff Requisition')
                    ->description('Fields 1-11 to be filled by Staff')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DatePicker::make('requisition_date')
                                    ->required()
                                    ->default(now()),
                                Select::make('request_type')
                                    ->options([
                                        'New' => 'New',
                                        'Update' => 'Update',
                                        'Delete' => 'Delete',
                                    ])
                                    ->required(),
                                TextInput::make('nickname')
                                    ->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('full_name')
                                    ->required(),
                                TextInput::make('job_title')
                                    ->required(),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('department')
                                    ->required(),
                                TextInput::make('office_location')
                                    ->required(),
                                TextInput::make('nik')
                                    ->label('NIK')
                                    ->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('email_purpose')
                                    ->options([
                                        'Personal Contact' => 'Personal Contact',
                                        'Functional' => 'Functional',
                                    ])
                                    ->live()
                                    ->required(),
                                TextInput::make('email_purpose_custom')
                                    ->label('Specify Functional Purpose')
                                    ->visible(fn (Get $get) => $get('email_purpose') === 'Functional')
                                    ->required(fn (Get $get) => $get('email_purpose') === 'Functional'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('distribution_list_initial')
                                    ->label('Distribution List (Requisition)')
                                    ->options([
                                        'All Medquest' => 'All Medquest',
                                        'Department Group' => 'Department Group',
                                        'Others' => 'Others',
                                    ])
                                    ->live()
                                    ->required(),
                                TextInput::make('distribution_list_initial_custom')
                                    ->label('Specify Other Distribution List')
                                    ->visible(fn (Get $get) => $get('distribution_list_initial') === 'Others')
                                    ->required(fn (Get $get) => $get('distribution_list_initial') === 'Others'),
                            ]),
                        Textarea::make('requisition_note')
                            ->columnSpanFull(),
                    ]),

                Section::make('Approval & Fulfillment')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('requester_id')
                                    ->relationship('requester', 'name')
                                    ->disabled()
                                    ->dehydrated(),
                                Select::make('dept_head_id')
                                    ->relationship('deptHead', 'name')
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('email_creation_date')
                                    ->label('Email Creation Date (ITD)'),
                                TextInput::make('email_address')
                                    ->email(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('password')
                                    ->password()
                                    ->revealable(),
                                TextInput::make('distribution_list_final')
                                    ->label('Final Distribution List (ITD)'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('itd_personnel_id')
                                    ->label('ITD Personnel')
                                    ->relationship('itdPersonnel', 'name')
                                    ->disabled()
                                    ->dehydrated(),
                                Select::make('itd_manager_id')
                                    ->label('ITD Manager')
                                    ->relationship('itdManager', 'name')
                                    ->disabled()
                                    ->dehydrated(),
                            ]),
                        Select::make('status')
                            ->options([
                                'Draft' => 'Draft',
                                'Submitted' => 'Submitted',
                                'Acknowledged' => 'Acknowledged',
                                'Fulfilled' => 'Fulfilled',
                                'Approved' => 'Approved',
                                'Rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('Draft'),
                    ]),
            ]);
    }
}