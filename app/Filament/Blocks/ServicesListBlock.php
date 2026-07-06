<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\TextInput;

class ServicesListBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('section_title')
                ->label(__('Section Title'))
                ->required()
                ->default(__('Explore Our Comprehensive Interior Design Services'))
                ->maxLength(255)
                ->helperText(__('Main section title displayed above each service gallery')),

            TextInput::make('gallery_limit')
                ->label(__('Images Per Service'))
                ->numeric()
                ->default(5)
                ->minValue(1)
                ->maxValue(10)
                ->required()
                ->helperText(__('Number of gallery images to display for each service (default: 5)')),
        ];
    }
}
