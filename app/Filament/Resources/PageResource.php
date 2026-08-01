<?php

namespace App\Filament\Resources;

use App\Filament\Blocks\AboutBenefitsBlock;
use App\Filament\Blocks\AboutContentBlock;
use App\Filament\Blocks\AboutHeroBlock;
use App\Filament\Blocks\AboutTimelineBlock;
use App\Filament\Blocks\BlogHeroBlock;
use App\Filament\Blocks\BlogListBlock;
use App\Filament\Blocks\FormBlock;
use App\Filament\Blocks\GalleryGridBlock;
use App\Filament\Blocks\HeroHomeBlock;
use App\Filament\Blocks\HeroInnerBlock;
use App\Filament\Blocks\NewsGridBlock;
use App\Filament\Blocks\RichTextBlock;
use App\Filament\Blocks\SectionHeadingBlock;
use App\Filament\Blocks\ServicesGridBlock;
use App\Filament\Blocks\ServicesHeroBlock;
use App\Filament\Blocks\ServicesListBlock;
use App\Filament\Blocks\TestimonialsCarouselBlock;
use App\Filament\Blocks\TimelineBlock;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', str($state)->slug()) : null),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Page::class, 'slug', ignoreRecord: true),

                        Forms\Components\Builder::make('blocks')
                            ->label('Page Blocks')
                            ->blocks([
                                Forms\Components\Builder\Block::make('hero-home')
                                    ->label('Hero - Home Page')
                                    ->icon('heroicon-o-photo')
                                    ->schema(HeroHomeBlock::make()),

                                Forms\Components\Builder\Block::make('hero-inner')
                                    ->label('Hero - Inner Page')
                                    ->icon('heroicon-o-photo')
                                    ->schema(HeroInnerBlock::make()),

                                Forms\Components\Builder\Block::make('about-hero')
                                    ->label('About Us Hero')
                                    ->icon('heroicon-o-photo')
                                    ->schema(AboutHeroBlock::make()),

                                Forms\Components\Builder\Block::make('about-content')
                                    ->label('About Us Content (Video + Text)')
                                    ->icon('heroicon-o-video-camera')
                                    ->schema(AboutContentBlock::make()),

                                Forms\Components\Builder\Block::make('about-timeline')
                                    ->label('About Us Timeline')
                                    ->icon('heroicon-o-clock')
                                    ->schema(AboutTimelineBlock::make()),

                                Forms\Components\Builder\Block::make('about-benefits')
                                    ->label('About Section with Benefits')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema(AboutBenefitsBlock::make()),

                                Forms\Components\Builder\Block::make('blog-hero')
                                    ->label('Blog Hero')
                                    ->icon('heroicon-o-photo')
                                    ->schema(BlogHeroBlock::make()),

                                Forms\Components\Builder\Block::make('blog-list')
                                    ->label('Blog Posts List')
                                    ->icon('heroicon-o-newspaper')
                                    ->schema(BlogListBlock::make()),

                                Forms\Components\Builder\Block::make('services-hero')
                                    ->label('Services Hero')
                                    ->icon('heroicon-o-photo')
                                    ->schema(ServicesHeroBlock::make()),

                                Forms\Components\Builder\Block::make('services-list')
                                    ->label('Services List with Galleries')
                                    ->icon('heroicon-o-square-3-stack-3d')
                                    ->schema(ServicesListBlock::make()),

                                Forms\Components\Builder\Block::make('services-grid')
                                    ->label('Services Grid')
                                    ->icon('heroicon-o-square-3-stack-3d')
                                    ->schema(ServicesGridBlock::make()),

                                Forms\Components\Builder\Block::make('news-grid')
                                    ->label('News / Blog Grid')
                                    ->icon('heroicon-o-newspaper')
                                    ->schema(NewsGridBlock::make()),

                                Forms\Components\Builder\Block::make('testimonials-carousel')
                                    ->label('Testimonials Carousel')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->schema(TestimonialsCarouselBlock::make()),

                                Forms\Components\Builder\Block::make('gallery-grid')
                                    ->label('Gallery Grid')
                                    ->icon('heroicon-o-photo')
                                    ->schema(GalleryGridBlock::make()),

                                Forms\Components\Builder\Block::make('timeline')
                                    ->label('Timeline')
                                    ->icon('heroicon-o-clock')
                                    ->schema(TimelineBlock::make()),

                                Forms\Components\Builder\Block::make('form-block')
                                    ->label('Contact Form')
                                    ->icon('heroicon-o-envelope')
                                    ->schema(FormBlock::make()),

                                Forms\Components\Builder\Block::make('rich-text')
                                    ->label('Rich Text')
                                    ->icon('heroicon-o-document-text')
                                    ->schema(RichTextBlock::make()),

                                Forms\Components\Builder\Block::make('section-heading')
                                    ->label('Section Heading')
                                    ->icon('heroicon-o-h1')
                                    ->schema(SectionHeadingBlock::make()),
                            ])
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->maxLength(60)
                            ->helperText('Recommended: 50-60 characters'),

                        Forms\Components\Textarea::make('seo_description')
                            ->maxLength(160)
                            ->rows(3)
                            ->helperText('Recommended: 150-160 characters'),
                    ])
                    ->collapsed(),

                Forms\Components\Section::make('Publishing')
                    ->schema([
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Publish Date')
                            ->helperText('Leave empty to keep as draft'),

                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('published_at')
                    ->label('Status')
                    ->boolean()
                    ->getStateUsing(fn ($record) => $record->isPublished())
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published Date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),

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
                Tables\Filters\Filter::make('published')
                    ->label('Published')
                    ->query(fn (Builder $query): Builder => $query->published()),

                Tables\Filters\Filter::make('draft')
                    ->label('Draft')
                    ->query(fn (Builder $query): Builder => $query->whereNull('published_at')),
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
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
