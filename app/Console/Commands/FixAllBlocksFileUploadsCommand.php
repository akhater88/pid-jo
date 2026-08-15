<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class FixAllBlocksFileUploadsCommand extends Command
{
    protected $signature = 'pages:fix-all-blocks-uploads {--dry-run : Show what would be changed without saving}';

    protected $description = 'Fix FileUpload fields in all page blocks to use proper array format';

    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No changes will be saved');
            $this->newLine();
        }

        $this->info('Fixing FileUpload fields in all page blocks...');
        $this->newLine();

        $pages = Page::all();
        $pagesFixed = 0;
        $fieldsFixed = 0;

        foreach ($pages as $page) {
            $pageUpdated = false;

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false) ?? [];
                $localeUpdated = false;

                // Skip if blocks is not an array (corrupted data)
                if (!is_array($blocks)) {
                    $this->warn("  [{$locale}] Page {$page->id}: Blocks is not an array - skipping (corrupted data)");
                    continue;
                }

                foreach ($blocks as $blockIndex => &$block) {
                    $blockType = $block['type'] ?? 'unknown';
                    $data = &$block['data'];

                    if (empty($data)) {
                        continue;
                    }

                    // Process all fields
                    foreach ($data as $fieldName => &$value) {
                        // Skip non-file fields (text, numbers, booleans, null)
                        if (is_null($value) || is_bool($value) || is_numeric($value)) {
                            continue;
                        }

                        // Only process fields that are likely FileUpload fields based on naming
                        $isLikelyFileField = preg_match('/(image|photo|picture|thumbnail|media|file|upload|pdf|attachment|icon|logo|avatar|banner|background)(_|$)/i', $fieldName);

                        if (!$isLikelyFileField) {
                            continue;
                        }

                        $originalValue = $value;
                        $changed = false;

                        // Case 1: String value that looks like a storage file path
                        if (is_string($value) && !empty($value)) {
                            // Check if it looks like a storage path (not an external URL or relative path)
                            if (preg_match('/\.(jpg|jpeg|png|gif|webp|pdf|svg)$/i', $value) &&
                                (str_starts_with($value, 'blocks/') ||
                                 str_starts_with($value, 'hero-images/') ||
                                 str_starts_with($value, 'uploads/') ||
                                 str_starts_with($value, 'media/') ||
                                 preg_match('/^\w+\//', $value))) {
                                $value = [$value];
                                $changed = true;
                                $this->info("  [{$locale}] {$blockType}.{$fieldName}: STRING → ARRAY");
                            }
                        }
                        // Case 2: UUID-keyed associative array
                        elseif (is_array($value) && !empty($value)) {
                            $keys = array_keys($value);

                            // Check if keys are not sequential integers starting from 0
                            if ($keys !== range(0, count($value) - 1)) {
                                $firstKey = $keys[0] ?? null;

                                // UUID pattern check or any non-integer keys
                                if (is_string($firstKey)) {
                                    $value = array_values($value);
                                    $changed = true;
                                    $this->info("  [{$locale}] {$blockType}.{$fieldName}: ASSOCIATIVE_ARRAY → INDEXED_ARRAY");
                                }
                            }
                        }

                        if ($changed) {
                            $fieldsFixed++;
                            $localeUpdated = true;
                            $pageUpdated = true;
                        }
                    }
                }

                if ($localeUpdated && !$dryRun) {
                    $page->setTranslation('blocks', $locale, $blocks);
                }
            }

            if ($pageUpdated) {
                $pagesFixed++;

                if (!$dryRun) {
                    $page->save();
                    $this->comment("  ✅ Saved page {$page->id} - " . $page->getTranslation('title', 'en'));
                }
            }
        }

        $this->newLine();

        if ($dryRun) {
            $this->warn("DRY RUN: Would fix {$fieldsFixed} field(s) in {$pagesFixed} page(s)");
            $this->info('Run without --dry-run to apply changes');
        } else {
            $this->info("✅ Fixed {$fieldsFixed} field(s) in {$pagesFixed} page(s)");

            if ($fieldsFixed > 0) {
                $this->info("\nClearing caches...");
                $this->call('cache:clear');
            }
        }

        return Command::SUCCESS;
    }
}
