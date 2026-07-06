<?php

namespace App\Filament\Blocks;

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
            TextInput::make('video_thumbnail')
                ->label(__('Video Thumbnail Image Path'))
                ->required()
                ->default('/images/about-video-thumb.jpg')
                ->maxLength(500)
                ->placeholder('/images/example.jpg')
                ->helperText(__('Enter the path to the video thumbnail image (e.g., /images/about-video-thumb.jpg). Recommended size: 1232x500px.')),

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
