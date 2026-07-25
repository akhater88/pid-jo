<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ServiceGalleryBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('heading')
                ->label(__('Heading'))
                ->default(__('Gallery'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->rows(2)
                ->helperText(__('Optional description above the gallery'))
                ->maxLength(500),
        ];
    }
}
