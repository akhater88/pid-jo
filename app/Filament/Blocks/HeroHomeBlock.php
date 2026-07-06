<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class HeroHomeBlock
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

            TextInput::make('cta_text')
                ->label(__('Button Text'))
                ->default(__('Get Started'))
                ->maxLength(100),

            TextInput::make('cta_url')
                ->label(__('Button URL'))
                ->url()
                ->default('/contact'),

            FileUpload::make('background_image')
                ->label(__('Background Image'))
                ->image()
                ->imageEditor()
                ->maxSize(5120)
                ->directory('hero-images')
                ->visibility('public')
                ->imagePreviewHeight('250')
                ->helperText(__('Recommended size: 1920x1080px'))
                ->columnSpanFull(),
        ];
    }
}
