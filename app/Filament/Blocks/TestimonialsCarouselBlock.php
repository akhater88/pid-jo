<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class TestimonialsCarouselBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('heading')
                ->label(__('Heading'))
                ->default(__('What Our Clients Say'))
                ->required()
                ->maxLength(255),

            TextInput::make('subheading')
                ->label(__('Subheading'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->rows(2)
                ->maxLength(500),
        ];
    }
}
