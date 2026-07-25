<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
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
            Section::make(__('Main Hero Content'))
                ->schema([
                    TextInput::make('badge_text')
                        ->label(__('Badge Text'))
                        ->default(__('Fast and Reliable'))
                        ->maxLength(100),

                    TextInput::make('title_highlight')
                        ->label(__('Title Highlighted Word'))
                        ->default(__('Manage'))
                        ->maxLength(100)
                        ->helperText(__('This word will appear in gold with underline')),

                    TextInput::make('title')
                        ->label(__('Title'))
                        ->required()
                        ->maxLength(255)
                        ->helperText(__('Main title text (highlighted word will be prepended)')),

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
                        ->default('/contact')
                        ->placeholder('/contact or https://example.com')
                        ->helperText(__('Enter a relative path (e.g., /contact, /services) or full URL (e.g., https://example.com)')),

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
                ])
                ->collapsible(),

            Section::make(__('Promo Card 1 (30% OFF)'))
                ->schema([
                    TextInput::make('promo_1_badge')
                        ->label(__('Badge Label'))
                        ->default('30% OFF')
                        ->required()
                        ->maxLength(50)
                        ->helperText(__('E.g., "30% OFF", "50% DISCOUNT"')),

                    TextInput::make('promo_1_title')
                        ->label(__('Title (Bold)'))
                        ->default(__('Visit our showroom'))
                        ->required()
                        ->maxLength(255),

                    TextInput::make('promo_1_subtitle')
                        ->label(__('Description'))
                        ->default(__('to get your 30% Discount'))
                        ->required()
                        ->maxLength(255),

                    FileUpload::make('promo_1_image')
                        ->label(__('Background Image'))
                        ->image()
                        ->imageEditor()
                        ->maxSize(5120)
                        ->directory('hero-images/promos')
                        ->visibility('public')
                        ->imagePreviewHeight('150')
                        ->helperText(__('Recommended size: 600x400px'))
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed(),

            Section::make(__('Promo Card 2 (20% OFF)'))
                ->schema([
                    TextInput::make('promo_2_badge')
                        ->label(__('Badge Label'))
                        ->default('20% OFF')
                        ->required()
                        ->maxLength(50)
                        ->helperText(__('E.g., "20% OFF", "BUY 1 GET 1"')),

                    TextInput::make('promo_2_title')
                        ->label(__('Title (Bold)'))
                        ->default(__('Visit our showroom'))
                        ->required()
                        ->maxLength(255),

                    TextInput::make('promo_2_subtitle')
                        ->label(__('Description'))
                        ->default(__('to get your 20% Discount'))
                        ->required()
                        ->maxLength(255),

                    FileUpload::make('promo_2_image')
                        ->label(__('Background Image'))
                        ->image()
                        ->imageEditor()
                        ->maxSize(5120)
                        ->directory('hero-images/promos')
                        ->visibility('public')
                        ->imagePreviewHeight('150')
                        ->helperText(__('Recommended size: 600x400px'))
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed(),
        ];
    }
}
