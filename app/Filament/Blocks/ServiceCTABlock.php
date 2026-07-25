<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ServiceCTABlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('heading')
                ->label(__('Heading'))
                ->default(__('Interested in this service?'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->default(__('Contact us today to discuss your project and get a free consultation.'))
                ->rows(2)
                ->maxLength(500),

            TextInput::make('button_text')
                ->label(__('Button Text'))
                ->default(__('Contact Us'))
                ->maxLength(100),

            TextInput::make('button_link')
                ->label(__('Button Link'))
                ->default('/contact')
                ->helperText(__('Use /contact for contact page or custom URL'))
                ->maxLength(255),
        ];
    }
}
