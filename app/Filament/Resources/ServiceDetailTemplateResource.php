<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceDetailTemplateResource\Pages;
use App\Filament\Resources\ServiceDetailTemplateResource\RelationManagers;
use App\Models\ServiceDetailTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceDetailTemplateResource extends Resource
{
    use Translatable;

    protected static ?string $model = ServiceDetailTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Template Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Template Name'))
                            ->required()
                            ->maxLength(255)
                            ->helperText(__('Internal name for this template')),

                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->helperText(__('Only one template can be active at a time'))
                            ->default(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Template Blocks')
                    ->schema([
                        Forms\Components\Builder::make('blocks')
                            ->label(__('Page Builder'))
                            ->blocks([
                                Forms\Components\Builder\Block::make('service-hero')
                                    ->label(__('Service Hero'))
                                    ->icon('heroicon-o-photo')
                                    ->schema(\App\Filament\Blocks\ServiceHeroBlock::make()),

                                Forms\Components\Builder\Block::make('service-content')
                                    ->label(__('Service Content'))
                                    ->icon('heroicon-o-document-text')
                                    ->schema(\App\Filament\Blocks\ServiceContentBlock::make()),

                                Forms\Components\Builder\Block::make('service-gallery')
                                    ->label(__('Service Gallery'))
                                    ->icon('heroicon-o-photo')
                                    ->schema(\App\Filament\Blocks\ServiceGalleryBlock::make()),

                                Forms\Components\Builder\Block::make('service-sections')
                                    ->label(__('Service Sections'))
                                    ->icon('heroicon-o-squares-2x2')
                                    ->schema(\App\Filament\Blocks\ServiceSectionsBlock::make()),

                                Forms\Components\Builder\Block::make('service-cta')
                                    ->label(__('Call to Action'))
                                    ->icon('heroicon-o-megaphone')
                                    ->schema(\App\Filament\Blocks\ServiceCTABlock::make()),
                            ])
                            ->collapsible()
                            ->addActionLabel(__('Add Block'))
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceDetailTemplates::route('/'),
            'create' => Pages\CreateServiceDetailTemplate::route('/create'),
            'edit' => Pages\EditServiceDetailTemplate::route('/{record}/edit'),
        ];
    }
}
