<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class SectionHeadingBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Title'))
                ->required()
                ->maxLength(255),

            TextInput::make('subtitle')
                ->label(__('Subtitle'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->rows(3)
                ->maxLength(500),

            Select::make('align')
                ->label(__('Alignment'))
                ->options([
                    'left' => __('Left'),
                    'center' => __('Center'),
                    'right' => __('Right'),
                ])
                ->default('center'),
        ];
    }
}
