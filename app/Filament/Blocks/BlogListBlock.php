<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\TextInput;

class BlogListBlock
{
    /**
     * @return array<\Filament\Forms\Components\Component>
     */
    public static function make(): array
    {
        return [
            TextInput::make('section_title')
                ->label(__('Section Title'))
                ->required()
                ->default(__('Explore Our Comprehensive Interior Design Services'))
                ->maxLength(255)
                ->helperText(__('Main section title displayed above the blog posts')),

            TextInput::make('section_badge')
                ->label(__('Section Badge'))
                ->required()
                ->default(__('News & Blogs'))
                ->maxLength(100)
                ->helperText(__('Badge text displayed in the pill above the title')),

            TextInput::make('posts_per_page')
                ->label(__('Posts Per Page'))
                ->numeric()
                ->default(9)
                ->minValue(1)
                ->maxValue(50)
                ->required()
                ->helperText(__('Number of blog posts to display per page')),
        ];
    }
}
