<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Section Title'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('type')
                    ->label(__('Section Type'))
                    ->options([
                        'text' => __('Text Content'),
                        'image' => __('Single Image'),
                        'video' => __('Video'),
                        'gallery' => __('Image Gallery'),
                    ])
                    ->default('text')
                    ->required()
                    ->reactive(),

                Forms\Components\RichEditor::make('content')
                    ->label(__('Content'))
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                    ])
                    ->visible(fn (Forms\Get $get) => $get('type') === 'text')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('media_data.image_path')
                    ->label(__('Image Path'))
                    ->placeholder('/images/example.jpg')
                    ->helperText(__('Enter the path to the image'))
                    ->visible(fn (Forms\Get $get) => $get('type') === 'image'),

                Forms\Components\TextInput::make('media_data.video_url')
                    ->label(__('Video URL'))
                    ->url()
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->helperText(__('Enter YouTube or Vimeo URL'))
                    ->visible(fn (Forms\Get $get) => $get('type') === 'video'),

                Forms\Components\Textarea::make('media_data.gallery_images')
                    ->label(__('Gallery Image Paths'))
                    ->placeholder('/images/gallery1.jpg, /images/gallery2.jpg')
                    ->helperText(__('Enter comma-separated image paths'))
                    ->rows(3)
                    ->visible(fn (Forms\Get $get) => $get('type') === 'gallery'),

                Forms\Components\TextInput::make('sort_order')
                    ->label(__('Sort Order'))
                    ->numeric()
                    ->default(0)
                    ->helperText(__('Lower numbers appear first')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'image' => 'success',
                        'video' => 'warning',
                        'gallery' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('Order'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc');
    }
}
