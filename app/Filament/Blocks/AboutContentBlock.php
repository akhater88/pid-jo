<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;

class AboutContentBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            FileUpload::make('video_thumbnail')
                ->label(__('Video Thumbnail Image'))
                ->required()
                ->disk('public')
                ->directory('blocks/video-thumbnails')
                ->image()
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '2.464:1',
                    '16:9',
                    null,
                ])
                ->maxSize(5120)
                ->imagePreviewHeight('200')
                ->helperText(__('Upload the video thumbnail image. Recommended size: 1232x500px. Max file size: 5MB.'))
                ->columnSpanFull(),

            TextInput::make('video_url')
                ->label(__('YouTube Video URL'))
                ->url()
                ->required()
                ->placeholder('https://www.youtube.com/watch?v=...')
                ->helperText(__('Enter the full YouTube video URL')),

            TextInput::make('content_title')
                ->label(__('Content Title'))
                ->required()
                ->maxLength(255)
                ->helperText(__('Main heading for the content section')),

            RichEditor::make('content_body')
                ->label(__('Content Body'))
                ->required()
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'link',
                    'bulletList',
                    'orderedList',
                    'h2',
                    'h3',
                ])
                ->helperText(__('Main text content describing the conference/event')),
        ];
    }
}
