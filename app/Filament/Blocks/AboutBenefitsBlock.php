<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class AboutBenefitsBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('section_label')
                ->label(__('Section Label'))
                ->default(__('About US'))
                ->maxLength(100),

            TextInput::make('section_title')
                ->label(__('Section Title'))
                ->required()
                ->default(__('What the Benefit to get Work with Pesaro'))
                ->maxLength(255),

            Textarea::make('description')
                ->label(__('Description'))
                ->rows(3)
                ->maxLength(1000),

            FileUpload::make('main_image')
                ->label(__('Main Image (Large)'))
                ->required()
                ->disk('public')
                ->directory('blocks/about-benefits')
                ->image()
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '4:3',
                    null,
                ])
                ->maxSize(5120)
                ->helperText(__('Upload the main image. Recommended size: 800x600px. Max file size: 5MB.')),

            FileUpload::make('small_image')
                ->label(__('Small Image (Overlay)'))
                ->required()
                ->disk('public')
                ->directory('blocks/about-benefits')
                ->image()
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '4:3',
                    null,
                ])
                ->maxSize(5120)
                ->helperText(__('Upload the small overlay image. Recommended size: 400x300px. Max file size: 5MB.')),

            Repeater::make('benefits')
                ->label(__('Benefits List'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('Benefit Title'))
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label(__('Benefit Description'))
                        ->rows(2)
                        ->maxLength(500),
                ])
                ->defaultItems(2)
                ->collapsible()
                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                ->addActionLabel(__('Add Benefit'))
                ->maxItems(6),
        ];
    }
}
