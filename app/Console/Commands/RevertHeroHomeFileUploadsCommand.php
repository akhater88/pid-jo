<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class RevertHeroHomeFileUploadsCommand extends Command
{
    protected $signature = 'pages:revert-hero-home-uploads';

    protected $description = 'Revert hero-home block FileUpload fields back to array format';

    public function handle()
    {
        $this->info('Reverting hero-home block FileUpload fields to array format...');

        $pages = Page::all();
        $fixed = 0;

        foreach ($pages as $page) {
            $updated = false;

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false) ?? [];

                foreach ($blocks as $blockIndex => &$block) {
                    if (($block['type'] ?? null) === 'hero-home') {
                        $data = &$block['data'];

                        // Fields to revert
                        $fileFields = [
                            'background_image',
                            'promo_1_image',
                            'promo_1_pdf',
                            'promo_2_image',
                            'promo_2_pdf',
                        ];

                        foreach ($fileFields as $field) {
                            if (isset($data[$field])) {
                                $value = $data[$field];

                                // Case 1: String - convert to simple array
                                if (is_string($value) && !empty($value)) {
                                    $data[$field] = [$value];
                                    $updated = true;
                                    $this->info("  Converted {$field} from string to array for page {$page->id} ({$locale})");
                                }
                                // Case 2: Associative array with UUID keys - extract values
                                elseif (is_array($value) && !empty($value) && array_keys($value) !== range(0, count($value) - 1)) {
                                    $data[$field] = array_values($value);
                                    $updated = true;
                                    $this->info("  Converted {$field} from associative array to indexed array for page {$page->id} ({$locale})");
                                }
                                // Case 3: Already a proper indexed array or empty - no change needed
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

        $this->info("\n✅ Reverted {$fixed} page(s)");

        $this->info("\nClearing caches...");
        $this->call('cache:clear');

        return Command::SUCCESS;
    }
}
