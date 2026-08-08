<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class FixHeroHomeFileUploadsCommand extends Command
{
    protected $signature = 'pages:fix-hero-home-uploads';

    protected $description = 'Fix hero-home block FileUpload fields to convert arrays to strings';

    public function handle()
    {
        $this->info('Fixing hero-home block FileUpload fields...');

        $pages = Page::all();
        $fixed = 0;

        foreach ($pages as $page) {
            $updated = false;

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false) ?? [];

                foreach ($blocks as $blockIndex => &$block) {
                    if (($block['type'] ?? null) === 'hero-home') {
                        $data = &$block['data'];

                        // Fields to fix
                        $fileFields = [
                            'background_image',
                            'promo_1_image',
                            'promo_1_pdf',
                            'promo_2_image',
                            'promo_2_pdf',
                        ];

                        foreach ($fileFields as $field) {
                            if (isset($data[$field]) && is_array($data[$field])) {
                                // Handle both formats:
                                // 1. Associative array with UUID keys: {"uuid": "path/to/file.jpg"}
                                // 2. Indexed array: [0 => "path/to/file.jpg"]
                                // 3. Empty array: []

                                if (empty($data[$field])) {
                                    // Empty array - set to null
                                    $data[$field] = null;
                                    $updated = true;
                                    $this->info("  Cleared empty {$field} for page {$page->id} ({$locale})");
                                } else {
                                    // Get the first value from the array (associative or indexed)
                                    $value = is_array($data[$field]) ? array_values($data[$field])[0] : $data[$field];

                                    $data[$field] = $value;
                                    $updated = true;
                                    $this->info("  Fixed {$field} for page {$page->id} ({$locale}): {$value}");
                                }
                            }
                        }
                    }
                }

                if ($updated) {
                    $page->setTranslation('blocks', $locale, $blocks);
                }
            }

            if ($updated) {
                $page->save();
                $fixed++;
            }
        }

        $this->info("\n✅ Fixed {$fixed} page(s)");

        $this->info("\nClearing caches...");
        $this->call('cache:clear');

        return Command::SUCCESS;
    }
}
