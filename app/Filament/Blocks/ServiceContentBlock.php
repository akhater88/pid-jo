<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\RichEditor;

class ServiceContentBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            RichEditor::make('content')
                ->label(__('Content'))
                ->default('{{service_body}}')
                ->helperText(__('Use {{service_body}} to display the full service description. You can also add custom text.'))
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'link',
                    'bulletList',
                    'orderedList',
                    'h2',
                    'h3',
                ])
                ->columnSpanFull(),
        ];
    }
}
