<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ServiceHeroBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('title')
                ->label(__('Title'))
                ->default('{{service_title}}')
                ->helperText(__('Use {{service_title}}, {{service_description}} as variables'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->default('{{service_description}}')
                ->rows(3)
                ->helperText(__('Use variables: {{service_title}}, {{service_description}}')),

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
                ->helperText(__('Recommended: 1920x1080px. Will be used as hero background.'))
                ->columnSpanFull(),
        ];
    }
}
