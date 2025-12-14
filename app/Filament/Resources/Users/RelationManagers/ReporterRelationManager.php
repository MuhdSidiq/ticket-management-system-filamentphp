<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\Tickets\TicketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ReporterRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets';

    protected static ?string $relatedResource = TicketResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),

            ])
            ->columns([
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('description')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('priority')
                    ->searchable()
                    ->badge(),
            ]);
    }
}


