<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class HeroInnerBlock
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
                ->maxLength(255),

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

            Repeater::make('breadcrumbs')
                ->label(__('Breadcrumbs'))
                ->schema([
                    TextInput::make('label')
                        ->label(__('Label'))
                        ->required(),
                    TextInput::make('url')
                        ->label(__('URL'))
                        ->placeholder('/services or https://example.com')
                        ->helperText(__('Relative path or full URL')),
                ])
                ->defaultItems(0)
                ->collapsible()
                ->helperText(__('Leave empty to auto-generate from current page')),
        ];
    }
}
