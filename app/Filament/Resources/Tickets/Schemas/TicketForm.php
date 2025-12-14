<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

use Filament\Infolists\Components\TextEntry;


class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->schema([
            Section::make('Rate limiting')
            ->description('Prevent abuse by limiting the number of requests per period')
            ->schema([

                FileUpload::make(name: 'attachment')
                ->disk('public')
                ->directory('tickets')
                ->image(),

                    TextInput::make('subject')
                        ->required(),
    
                    Textarea::make('description')
                        ->required()
                        ->columnSpanFull(),
    
                    Select::make('reporter_id')
                        ->label('Reporter')
                        ->relationship('reporter', 'name')
                        ->required()
                        ->default(Auth::id())
                        ->disabled()
                        ->dehydrated(), 
    
                        
                    Select::make('status')
                        ->required()
                        ->options([
                            'open' => 'Open',
                            'closed' => 'Closed',
                            'resolved' => 'Resolved',
                            'in_progress' => 'In Progress',
                        ]),
    
                    Select::make('priority')
                        ->required()
                        ->options([
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High',
                        ]),
                    ]),
                    Section::make('Ticket information')
            ->schema([
                TextEntry::make('subject')
                    ->label('Subject'),

                TextEntry::make('description')
                    ->label('Description')
                    ->columnSpanFull(),

                TextEntry::make('reporter.name')
                    ->label('Reporter'),

                TextEntry::make('assignee.name')
                    ->label('Person in charge'),
            ])
            ->columns(2),
        ]);
    }
}
