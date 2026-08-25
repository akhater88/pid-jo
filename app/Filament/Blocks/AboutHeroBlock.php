<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class AboutHeroBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Page Title'))
                ->required()
                ->default(__('About Us'))
                ->maxLength(255),

            FileUpload::make('background_image')
                ->label(__('Background Image'))
                ->image()
                ->imageEditor()
                ->multiple()
                ->maxFiles(1)
                ->maxSize(5120)
                ->directory('hero-images')
                ->visibility('public')
                ->imagePreviewHeight('250')
                ->helperText(__('Recommended size: 1920x600px'))
                ->columnSpanFull(),
        ];
    }
}
