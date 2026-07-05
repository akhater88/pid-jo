<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ServicesGridBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('heading')
                ->label(__('Heading'))
                ->default(__('Our Services'))
                ->required()
                ->maxLength(255),

            TextInput::make('subheading')
                ->label(__('Subheading'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->rows(2)
                ->maxLength(500),

            TextInput::make('limit')
                ->label(__('Number of Services to Show'))
                ->numeric()
                ->default(6)
                ->minValue(1)
                ->maxValue(50),

            Toggle::make('show_all_link')
                ->label(__('Show "View All" Link'))
                ->default(true),
        ];
    }
}
