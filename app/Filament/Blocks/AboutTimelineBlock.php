<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
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
                    FileUpload::make('timeline_1951_image')
                        ->label(__('1951 Timeline Image'))
                        ->required()
                        ->disk('public')
                        ->directory('blocks/timeline')
                        ->image()
                        ->imageEditor()
                        ->maxSize(5120)
                        ->imagePreviewHeight('120')
                        ->helperText(__('Upload the 1951 timeline image. Recommended size: 130x120px. Max file size: 5MB.')),
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
                    FileUpload::make('timeline_2026_image')
                        ->label(__('2026 Timeline Image'))
                        ->required()
                        ->disk('public')
                        ->directory('blocks/timeline')
                        ->image()
                        ->imageEditor()
                        ->maxSize(5120)
                        ->imagePreviewHeight('120')
                        ->helperText(__('Upload the 2026 timeline image. Recommended size: 130x120px. Max file size: 5MB.')),
                ])
                ->collapsible(),
        ];
    }
}
