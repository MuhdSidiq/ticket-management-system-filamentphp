<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use App\Filament\Resources\Tickets\TicketResource;



class TicketTable extends TableWidget
{

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Ticket::query())
            ->columns([
                TextColumn::make('reporter.name')
                    ->label('Reporter')
                    ->sortable(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('status')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'open' => 'Open',
                        'closed' => 'Closed',
                        'resolved' => 'Resolved',
                        'in_progress' => 'In Progress',
                        default => $state,
                    })
                    ->badge(),
                TextColumn::make('priority')
                    ->sortable(true)
                    ->badge()
                    ->icon(Heroicon::OutlinedExclamationCircle)
                    ->color(fn (string $state): string => match ($state) {
                        'low' => 'success',
                        'medium' => 'warning',
                        'high' => 'danger',
                        default => 'gray',
                    }),
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
            ->headerActions([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                EditAction::make(),
                Action::make('mark_as_resolved')
                    ->label('Resolved')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->action(function (Ticket $record) {
                        $record->update([
                            'status' => 'resolved',
                        ]);
                    }),
                ])
                
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
