<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Settings\LegalSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageLegalSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Legal Pages';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected static string $settings = LegalSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Legal Pages')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Terms & Conditions')
                            ->schema([
                                Forms\Components\Section::make(__('Terms & Conditions Page'))
                                    ->description(__('Manage the content of your Terms & Conditions page'))
                                    ->schema([
                                        Forms\Components\TextInput::make('terms_title.en')
                                            ->label(__('Title (English)'))
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('terms_title.ar')
                                            ->label(__('Title (Arabic)'))
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\RichEditor::make('terms_content.en')
                                            ->label(__('Content (English)'))
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'h2',
                                                'h3',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                                'undo',
                                                'redo',
                                            ])
                                            ->columnSpanFull(),

                                        Forms\Components\RichEditor::make('terms_content.ar')
                                            ->label(__('Content (Arabic)'))
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'h2',
                                                'h3',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                                'undo',
                                                'redo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Privacy Policy')
                            ->schema([
                                Forms\Components\Section::make(__('Privacy Policy Page'))
                                    ->description(__('Manage the content of your Privacy Policy page'))
                                    ->schema([
                                        Forms\Components\TextInput::make('privacy_title.en')
                                            ->label(__('Title (English)'))
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('privacy_title.ar')
                                            ->label(__('Title (Arabic)'))
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\RichEditor::make('privacy_content.en')
                                            ->label(__('Content (English)'))
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'h2',
                                                'h3',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                                'undo',
                                                'redo',
                                            ])
                                            ->columnSpanFull(),

                                        Forms\Components\RichEditor::make('privacy_content.ar')
                                            ->label(__('Content (Arabic)'))
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'h2',
                                                'h3',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                                'undo',
                                                'redo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return __('Legal Pages');
    }

    public function getTitle(): string
    {
        return __('Legal Pages');
    }

    public function getHeading(): string
    {
        return __('Legal Pages');
    }
}
