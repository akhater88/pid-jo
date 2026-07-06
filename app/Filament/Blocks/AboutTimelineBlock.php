<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class AboutTimelineBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('section_title')
                ->label(__('Section Title'))
                ->required()
                ->default(__('Explore Our Comprehensive Interior Design Services'))
                ->maxLength(255),

            TextInput::make('section_badge')
                ->label(__('Section Badge'))
                ->required()
                ->default(__('Our Story'))
                ->maxLength(100),

            Section::make('1951 Timeline')
                ->schema([
                    TextInput::make('timeline_1951_image')
                        ->label(__('1951 Image Path'))
                        ->required()
                        ->default('/images/timeline-1951.jpg')
                        ->maxLength(500)
                        ->placeholder('/images/example.jpg')
                        ->helperText(__('Enter the path to the 1951 timeline image (e.g., /images/timeline-1951.jpg). Recommended size: 130x120px.')),
                ])
                ->collapsible(),

            Section::make('Center Content')
                ->schema([
                    TextInput::make('center_title')
                        ->label(__('Center Card Title'))
                        ->required()
                        ->maxLength(255)
                        ->default(__('Supervision & execution Accessories')),

                    Textarea::make('center_description')
                        ->label(__('Center Card Description'))
                        ->required()
                        ->rows(3)
                        ->maxLength(500)
                        ->default(__('Powerful project management tools for your companies of all sizes.')),
                ])
                ->collapsible(),

            Section::make('2026 Timeline')
                ->schema([
                    TextInput::make('timeline_2026_image')
                        ->label(__('2026 Image Path'))
                        ->required()
                        ->default('/images/timeline-2026.jpg')
                        ->maxLength(500)
                        ->placeholder('/images/example.jpg')
                        ->helperText(__('Enter the path to the 2026 timeline image (e.g., /images/timeline-2026.jpg). Recommended size: 130x120px.')),
                ])
                ->collapsible(),
        ];
    }
}
