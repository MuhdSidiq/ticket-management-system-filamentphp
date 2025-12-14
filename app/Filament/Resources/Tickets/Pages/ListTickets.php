<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Resources\Tickets\TicketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }


    public function getTabs(): array
{
    return [
        'all' => Tab::make('All')
            ->modifyQueryUsing(fn (Builder $query) => $query),
        'open' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'open')),
        'closed' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'closed')),
        'resolved' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'resolved')),
        'in_progress' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'in_progress')),
    ];
}
}
