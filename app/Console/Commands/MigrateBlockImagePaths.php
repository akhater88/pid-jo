<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class MigrateBlockImagePaths extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'blocks:migrate-image-paths';

    /**
     * The console command description.
     */
    protected $description = 'Migrate old string image paths to null for FileUpload fields';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Migrating old image paths in page blocks...');

        $imageFields = [
            'main_image',
            'small_image',
            'background_image',
            'promo_1_image',
            'promo_2_image',
            'video_thumbnail',
            'timeline_1951_image',
            'timeline_2026_image',
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

                $blocksUpdated = $this->migrateBlocksRecursively($blocks, $imageFields);

                if ($blocksUpdated) {
                    $page->setTranslation('blocks', $locale, $blocks);
                    $pageUpdated = true;
                }
            }

            if ($pageUpdated) {
                $page->saveQuietly(); // Save without triggering events
                $updatedCount++;
                $this->line("  ✓ Updated page: {$page->getTranslation('title', 'en')}");
            }
        }

        $this->info("Migration complete! Updated {$updatedCount} page(s).");

        return Command::SUCCESS;
    }

    /**
     * Recursively migrate image paths in blocks array
     */
    private function migrateBlocksRecursively(array &$blocks, array $imageFields): bool
    {
        $updated = false;

        foreach ($blocks as $key => &$value) {
            if (is_array($value)) {
                // Check if this is a block data array
                if (isset($value['data']) && is_array($value['data'])) {
                    foreach ($value['data'] as $dataKey => &$dataValue) {
                        // If this is an image field with a string value, clear it
                        if (in_array($dataKey, $imageFields) && is_string($dataValue)) {
                            $this->line("    - Clearing {$dataKey}: {$dataValue}");
                            $dataValue = null;
                            $updated = true;
                        }
                    }
                }

                // Recursively check nested arrays
                if ($this->migrateBlocksRecursively($value, $imageFields)) {
                    $updated = true;
                }
            }
        }

        return $updated;
    }
}
