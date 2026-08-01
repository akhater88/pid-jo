<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSiteSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SiteSettings::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 100;

    public static function getNavigationLabel(): string
    {
        return __('Site Settings');
    }

    public function getTitle(): string
    {
        return __('Site Settings');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Contact Information'))
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('administration_phone.en')
                                    ->label(__('Administration Phone (English)'))
                                    ->tel()
                                    ->required()
                                    ->placeholder('+962 6 55 3 11 77 , +962 77 00 2 32 42')
                                    ->helperText(__('Enter phone number(s) separated by comma')),

                                Forms\Components\TextInput::make('administration_phone.ar')
                                    ->label(__('Administration Phone (Arabic)'))
                                    ->tel()
                                    ->required()
                                    ->placeholder('+962 6 55 3 11 77 , +962 77 00 2 32 42')
                                    ->helperText(__('Enter phone number(s) separated by comma')),

                                Forms\Components\TextInput::make('showroom_phone.en')
                                    ->label(__('Showroom Phone (English)'))
                                    ->tel()
                                    ->required()
                                    ->placeholder('+962 6 567 58 58 , +962 77 100 23 23')
                                    ->helperText(__('Enter phone number(s) separated by comma')),

                                Forms\Components\TextInput::make('showroom_phone.ar')
                                    ->label(__('Showroom Phone (Arabic)'))
                                    ->tel()
                                    ->required()
                                    ->placeholder('+962 6 567 58 58 , +962 77 100 23 23')
                                    ->helperText(__('Enter phone number(s) separated by comma')),

                                Forms\Components\TextInput::make('email')
                                    ->label(__('Email Address'))
                                    ->email()
                                    ->required()
                                    ->placeholder('info@pid-jo.com')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('location.en')
                                    ->label(__('Location (English)'))
                                    ->required()
                                    ->placeholder('Amman, Jordan - Khalda, Rawan Mall'),

                                Forms\Components\TextInput::make('location.ar')
                                    ->label(__('Location (Arabic)'))
                                    ->required()
                                    ->placeholder('عمان، الأردن - خلدا، روان مول'),
                            ]),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make(__('Social Media Links'))
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('facebook_url')
                                    ->label(__('Facebook URL'))
                                    ->url()
                                    ->placeholder('https://facebook.com/pesaro')
                                    ->helperText(__('Leave empty to hide the icon')),

                                Forms\Components\TextInput::make('instagram_url')
                                    ->label(__('Instagram URL'))
                                    ->url()
                                    ->placeholder('https://instagram.com/pesaro')
                                    ->helperText(__('Leave empty to hide the icon')),

                                Forms\Components\TextInput::make('linkedin_url')
                                    ->label(__('LinkedIn URL'))
                                    ->url()
                                    ->placeholder('https://linkedin.com/company/pesaro')
                                    ->helperText(__('Leave empty to hide the icon')),

                                Forms\Components\TextInput::make('youtube_url')
                                    ->label(__('YouTube URL'))
                                    ->url()
                                    ->placeholder('https://youtube.com/@pesaro')
                                    ->helperText(__('Leave empty to hide the icon')),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }
}
