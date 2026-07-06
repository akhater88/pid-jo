<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class MigrateHeroImagesTOStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:hero-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate hero background images from /images to storage paths';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting migration of hero images...');

        $mapping = [
            '/images/hero-bg.jpg' => 'hero-images/hero-home-bg.jpg',
            '/images/hero-home-bg.jpg' => 'hero-images/hero-home-bg.jpg',
            '/images/about-hero-bg.jpg' => 'hero-images/about-hero-bg.jpg',
            '/images/about-hero-bg-new.jpg' => 'hero-images/about-hero-bg.jpg',
            '/images/services-hero-bg.jpg' => 'hero-images/services-hero-bg.jpg',
            '/images/blog-hero-bg.jpg' => 'hero-images/blog-hero-bg.jpg',
            '/images/hero-inner-bg.jpg' => 'hero-images/hero-inner-bg.jpg',
        ];

        $pages = Page::all();
        $updatedCount = 0;

        foreach ($pages as $page) {
            $updated = false;

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false);

                if (!is_array($blocks)) {
                    continue;
                }

                foreach ($blocks as $index => $block) {
                    if (!isset($block['data']['background_image'])) {
                        continue;
                    }

                    $oldPath = $block['data']['background_image'];

                    // Check if it's an old path that needs migration
                    if (isset($mapping[$oldPath])) {
                        $blocks[$index]['data']['background_image'] = $mapping[$oldPath];
                        $updated = true;
                        $this->line("  Updated: {$oldPath} → {$mapping[$oldPath]}");
                    }
                }

                if ($updated) {
                    $page->setTranslation('blocks', $locale, $blocks);
                }
            }

            if ($updated) {
                $page->save();
                $updatedCount++;
                $this->info("✓ Updated page: {$page->getTranslation('title', 'en')}");
            }
        }

        $this->info("Migration complete! Updated {$updatedCount} pages.");

        return Command::SUCCESS;
    }
}
