<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class GalleryGridBlock
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

            Select::make('columns')
                ->label(__('Number of Columns'))
                ->options([
                    2 => '2 ' . __('Columns'),
                    3 => '3 ' . __('Columns'),
                    4 => '4 ' . __('Columns'),
                ])
                ->default(3)
                ->required(),

            TextInput::make('limit')
                ->label(__('Number of Images to Show'))
                ->numeric()
                ->default(12)
                ->minValue(1)
                ->maxValue(50),
        ];
    }
}
