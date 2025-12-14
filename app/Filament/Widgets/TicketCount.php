<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Ticket;
use Filament\Support\Icons\Heroicon;

class TicketCount extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            
            Stat::make('Total Tickets', Ticket::count())
                ->description('Total number of tickets')
                ->descriptionIcon(Heroicon::OutlinedTicket)
                ->color('success'),
            Stat::make('Open Tickets', Ticket::where('status', 'open')->count())
                ->description('Number of open tickets')
                ->descriptionIcon(Heroicon::OutlinedTicket)
                ->color('warning'),
            Stat::make('Closed Tickets', Ticket::where('status', 'closed')->count())
                ->description('Number of closed tickets')
                ->descriptionIcon(Heroicon::OutlinedTicket)
                ->color('danger'),


        ];
    }
}
