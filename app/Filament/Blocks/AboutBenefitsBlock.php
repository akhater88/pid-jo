<?php

namespace App\Filament\Blocks;

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

            TextInput::make('main_image')
                ->label(__('Main Image Path (Large)'))
                ->required()
                ->default('/images/about-main.jpg')
                ->maxLength(500)
                ->placeholder('/images/example.jpg')
                ->helperText(__('Enter the path to the main image (e.g., /images/about-main.jpg). Recommended size: 800x600px.')),

            TextInput::make('small_image')
                ->label(__('Small Image Path (Overlay)'))
                ->required()
                ->default('/images/about-small.jpg')
                ->maxLength(500)
                ->placeholder('/images/example.jpg')
                ->helperText(__('Enter the path to the small overlay image (e.g., /images/about-small.jpg). Recommended size: 400x300px.')),

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
