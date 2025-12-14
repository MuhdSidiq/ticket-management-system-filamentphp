<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reporter.name')
                    ->label('Reporter')
                    ->sortable(),
                TextColumn::make('subject')
                    ->searchable(),
                // TextColumn::make('status')
                //     ->sortable()
                //     ->formatStateUsing(fn (string $state): string => match ($state) {
                //         'open' => 'Open',
                //         'closed' => 'Closed',
                //         'resolved' => 'Resolved',
                //         'in_progress' => 'In Progress',
                //         default => $state,
                //     })
                //     ->badge(),
                // TextColumn::make('priority')
                //     ->sortable(true)
                //     ->badge()
                //     ->icon(Heroicon::OutlinedExclamationCircle)
                //     ->color(fn (string $state): string => match ($state) {
                //         'low' => 'success',
                //         'medium' => 'warning',
                //         'high' => 'danger',
                //         default => 'gray',
                //     }),
                TextColumn::make('created_at')
                    ->date('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->time('H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
