<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class FormBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('heading')
                ->label(__('Heading'))
                ->default(__('Get In Touch'))
                ->required()
                ->maxLength(255),

            TextInput::make('subheading')
                ->label(__('Subheading'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->rows(2)
                ->maxLength(500),

            Textarea::make('success_message')
                ->label(__('Success Message'))
                ->default(__('Thank you! We will get back to you soon.'))
                ->rows(2)
                ->maxLength(500),
        ];
    }
}
