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
                                    ->required()
                                    ->placeholder('+962 6 55 3 11 77 , +962 77 00 2 32 42')
                                    ->helperText(__('Enter phone number(s) separated by comma. Each number should start with + and country code.'))
                                    ->rules([
                                        'required',
                                        function () {
                                            return function (string $attribute, $value, \Closure $fail) {
                                                $phones = array_map('trim', explode(',', $value));
                                                foreach ($phones as $phone) {
                                                    if (empty($phone)) {
                                                        continue;
                                                    }
                                                    // Validate phone format: should start with + and contain only digits, spaces, and basic formatting
                                                    if (! preg_match('/^\+[\d\s\-()]+$/', $phone)) {
                                                        $fail(__('Each phone number must start with + followed by country code and digits. Invalid number: :phone', ['phone' => $phone]));

                                                        return;
                                                    }
                                                }
                                            };
                                        },
                                    ]),

                                Forms\Components\TextInput::make('administration_phone.ar')
                                    ->label(__('Administration Phone (Arabic)'))
                                    ->required()
                                    ->placeholder('+962 6 55 3 11 77 , +962 77 00 2 32 42')
                                    ->helperText(__('Enter phone number(s) separated by comma. Each number should start with + and country code.'))
                                    ->rules([
                                        'required',
                                        function () {
                                            return function (string $attribute, $value, \Closure $fail) {
                                                $phones = array_map('trim', explode(',', $value));
                                                foreach ($phones as $phone) {
                                                    if (empty($phone)) {
                                                        continue;
                                                    }
                                                    if (! preg_match('/^\+[\d\s\-()]+$/', $phone)) {
                                                        $fail(__('Each phone number must start with + followed by country code and digits. Invalid number: :phone', ['phone' => $phone]));

                                                        return;
                                                    }
                                                }
                                            };
                                        },
                                    ]),

                                Forms\Components\TextInput::make('showroom_phone.en')
                                    ->label(__('Showroom Phone (English)'))
                                    ->required()
                                    ->placeholder('+962 6 567 58 58 , +962 77 100 23 23')
                                    ->helperText(__('Enter phone number(s) separated by comma. Each number should start with + and country code.'))
                                    ->rules([
                                        'required',
                                        function () {
                                            return function (string $attribute, $value, \Closure $fail) {
                                                $phones = array_map('trim', explode(',', $value));
                                                foreach ($phones as $phone) {
                                                    if (empty($phone)) {
                                                        continue;
                                                    }
                                                    if (! preg_match('/^\+[\d\s\-()]+$/', $phone)) {
                                                        $fail(__('Each phone number must start with + followed by country code and digits. Invalid number: :phone', ['phone' => $phone]));

                                                        return;
                                                    }
                                                }
                                            };
                                        },
                                    ]),

                                Forms\Components\TextInput::make('showroom_phone.ar')
                                    ->label(__('Showroom Phone (Arabic)'))
                                    ->required()
                                    ->placeholder('+962 6 567 58 58 , +962 77 100 23 23')
                                    ->helperText(__('Enter phone number(s) separated by comma. Each number should start with + and country code.'))
                                    ->rules([
                                        'required',
                                        function () {
                                            return function (string $attribute, $value, \Closure $fail) {
                                                $phones = array_map('trim', explode(',', $value));
                                                foreach ($phones as $phone) {
                                                    if (empty($phone)) {
                                                        continue;
                                                    }
                                                    if (! preg_match('/^\+[\d\s\-()]+$/', $phone)) {
                                                        $fail(__('Each phone number must start with + followed by country code and digits. Invalid number: :phone', ['phone' => $phone]));

                                                        return;
                                                    }
                                                }
                                            };
                                        },
                                    ]),

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

                Forms\Components\Section::make(__('Footer Settings'))
                    ->schema([
                        Forms\Components\FileUpload::make('footer_background_image')
                            ->label(__('Footer Background Image'))
                            ->image()
                            ->directory('footer')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                            ->maxSize(5120)
                            ->imageEditor()
                            ->helperText(__('Upload a background image for the footer (recommended size: 1920x400px)')),

                        Forms\Components\TextInput::make('google_maps_url')
                            ->label(__('Google Maps Location URL'))
                            ->url()
                            ->placeholder('https://maps.google.com/?q=31.9539,35.9106')
                            ->helperText(__('Enter the Google Maps URL for your business location. Clicking the footer background will open this location.')),
                    ])
                    ->collapsible(),
            ]);
    }
}
