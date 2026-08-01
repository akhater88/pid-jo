<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
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
                    Radio::make('promo_1_mode')
                        ->label(__('Promo Type'))
                        ->options([
                            'text' => __('Text Content (Title & Subtitle)'),
                            'pdf' => __('PDF Download'),
                        ])
                        ->default('text')
                        ->required()
                        ->inline()
                        ->reactive()
                        ->helperText(__('Choose whether to display text content or provide a downloadable PDF'))
                        ->columnSpanFull(),

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
                        ->maxLength(255)
                        ->helperText(__('For text mode: main title. For PDF mode: title shown above download button')),

                    TextInput::make('promo_1_subtitle')
                        ->label(__('Description'))
                        ->default(__('to get your 30% Discount'))
                        ->required(fn ($get) => $get('promo_1_mode') === 'text')
                        ->maxLength(255)
                        ->hidden(fn ($get) => $get('promo_1_mode') === 'pdf')
                        ->helperText(__('Only shown in text mode')),

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

                    FileUpload::make('promo_1_pdf')
                        ->label(__('PDF File'))
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(10240)
                        ->directory('hero-pdfs')
                        ->visibility('public')
                        ->required(fn ($get) => $get('promo_1_mode') === 'pdf')
                        ->hidden(fn ($get) => $get('promo_1_mode') !== 'pdf')
                        ->helperText(__('Upload the PDF file users will download when clicking the promo card'))
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed(),

            Section::make(__('Promo Card 2 (20% OFF)'))
                ->schema([
                    Radio::make('promo_2_mode')
                        ->label(__('Promo Type'))
                        ->options([
                            'text' => __('Text Content (Title & Subtitle)'),
                            'pdf' => __('PDF Download'),
                        ])
                        ->default('text')
                        ->required()
                        ->inline()
                        ->reactive()
                        ->helperText(__('Choose whether to display text content or provide a downloadable PDF'))
                        ->columnSpanFull(),

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
                        ->maxLength(255)
                        ->helperText(__('For text mode: main title. For PDF mode: title shown above download button')),

                    TextInput::make('promo_2_subtitle')
                        ->label(__('Description'))
                        ->default(__('to get your 20% Discount'))
                        ->required(fn ($get) => $get('promo_2_mode') === 'text')
                        ->maxLength(255)
                        ->hidden(fn ($get) => $get('promo_2_mode') === 'pdf')
                        ->helperText(__('Only shown in text mode')),

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

                    FileUpload::make('promo_2_pdf')
                        ->label(__('PDF File'))
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(10240)
                        ->directory('hero-pdfs')
                        ->visibility('public')
                        ->required(fn ($get) => $get('promo_2_mode') === 'pdf')
                        ->hidden(fn ($get) => $get('promo_2_mode') !== 'pdf')
                        ->helperText(__('Upload the PDF file users will download when clicking the promo card'))
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed(),
        ];
    }
}
