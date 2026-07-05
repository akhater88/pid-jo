<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;

class RichTextBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            RichEditor::make('content')
                ->label(__('Content'))
                ->required()
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                    'link',
                    'heading',
                    'bulletList',
                    'orderedList',
                    'blockquote',
                    'codeBlock',
                    'undo',
                    'redo',
                ])
                ->columnSpanFull(),

            Select::make('background')
                ->label(__('Background Color'))
                ->options([
                    'dark' => __('Dark'),
                    'light' => __('Light'),
                    'secondary' => __('Secondary'),
                ])
                ->default('dark'),

            Select::make('max_width')
                ->label(__('Maximum Width'))
                ->options([
                    'prose' => __('Standard (prose)'),
                    'wide' => __('Wide'),
                    'full' => __('Full Width'),
                ])
                ->default('prose'),
        ];
    }
}
