<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class RestoreBlockImagePaths extends Command
{
    protected $signature = 'blocks:restore-image-paths';

    protected $description = 'Restore default image paths for blocks';

    public function handle(): int
    {
        $this->info('Restoring default image paths...');

        // Default paths for common blocks
        $defaults = [
            'about-hero' => [
                'background_image' => 'hero-images/about-hero-bg.jpg',
            ],
            'about-content' => [
                'video_thumbnail' => '/images/about-content-image.jpg',
            ],
            'about-timeline' => [
                'timeline_1951_image' => '/images/about-timeline-1951.jpg',
                'timeline_2026_image' => '/images/about-timeline-2026.jpg',
            ],
            'blog-hero' => [
                'background_image' => 'hero-images/blog-hero-bg.jpg',
            ],
            'services-hero' => [
                'background_image' => 'hero-images/services-hero-bg.jpg',
            ],
        ];

        $pages = Page::all();
        $updatedCount = 0;

        foreach ($pages as $page) {
            $locales = ['en', 'ar'];
            $pageUpdated = false;

            foreach ($locales as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false);

                if (!is_array($blocks)) {
                    continue;
                }

                if ($this->restoreBlockDefaults($blocks, $defaults)) {
                    $page->setTranslation('blocks', $locale, $blocks);
                    $pageUpdated = true;
                }
            }

            if ($pageUpdated) {
                $page->saveQuietly();
                $updatedCount++;
                $this->line("  ✓ Restored: {$page->getTranslation('title', 'en')}");
            }
        }

        $this->info("Restoration complete! Updated {$updatedCount} page(s).");

        return Command::SUCCESS;
    }

    private function restoreBlockDefaults(array &$blocks, array $defaults): bool
    {
        $updated = false;

        foreach ($blocks as &$value) {
            if (is_array($value)) {
                if (isset($value['type'], $value['data']) && isset($defaults[$value['type']])) {
                    foreach ($defaults[$value['type']] as $field => $defaultValue) {
                        if (!isset($value['data'][$field]) || $value['data'][$field] === null) {
                            $value['data'][$field] = $defaultValue;
                            $this->line("    - Restored {$field} for {$value['type']}");
                            $updated = true;
                        }
                    }
                }

                if ($this->restoreBlockDefaults($value, $defaults)) {
                    $updated = true;
                }
            }
        }

        return $updated;
    }
}
