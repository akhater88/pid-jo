<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class TimelineBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('heading')
                ->label(__('Heading'))
                ->maxLength(255),

            TextInput::make('subheading')
                ->label(__('Subheading'))
                ->maxLength(255),

            Repeater::make('items')
                ->label(__('Timeline Items'))
                ->schema([
                    TextInput::make('year')
                        ->label(__('Year / Date'))
                        ->required()
                        ->maxLength(50),

                    TextInput::make('title')
                        ->label(__('Title'))
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label(__('Description'))
                        ->required()
                        ->rows(3)
                        ->maxLength(1000),
                ])
                ->defaultItems(1)
                ->collapsible()
                ->cloneable()
                ->reorderable(),
        ];
    }
}
