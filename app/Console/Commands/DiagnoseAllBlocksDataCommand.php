<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class DiagnoseAllBlocksDataCommand extends Command
{
    protected $signature = 'pages:diagnose-all-blocks';

    protected $description = 'Diagnose all page blocks for FileUpload field data format issues';

    public function handle()
    {
        $this->info('Diagnosing all page blocks for data format issues...');
        $this->newLine();

        $pages = Page::all();
        $issuesFound = 0;

        foreach ($pages as $page) {
            $this->info("Page ID: {$page->id} - Title: " . $page->getTranslation('title', 'en'));

            foreach (['en', 'ar'] as $locale) {
                $blocks = $page->getTranslation('blocks', $locale, false) ?? [];

                // Skip if blocks is not an array (corrupted data)
                if (!is_array($blocks)) {
                    $this->error("  [{$locale}] Blocks is not an array - corrupted data: " . gettype($blocks));
                    continue;
                }

                foreach ($blocks as $blockIndex => $block) {
                    $blockType = $block['type'] ?? 'unknown';
                    $data = $block['data'] ?? [];

                    if (empty($data)) {
                        continue;
                    }

                    $blockIssues = [];

                    // Check all fields for potential FileUpload format issues
                    foreach ($data as $fieldName => $value) {
                        // Skip non-file fields (text, numbers, booleans, null)
                        if (is_null($value) || is_bool($value) || is_numeric($value)) {
                            continue;
                        }

                        // Only check fields that are likely FileUpload fields based on naming
                        $isLikelyFileField = preg_match('/(image|photo|picture|thumbnail|media|file|upload|pdf|attachment|icon|logo|avatar|banner|background)(_|$)/i', $fieldName);

                        if (!$isLikelyFileField) {
                            continue;
                        }

                        // Check for string values in file fields
                        if (is_string($value) && !empty($value)) {
                            // Check if it looks like a storage path (not an external URL or relative path like "/services")
                            if (preg_match('/\.(jpg|jpeg|png|gif|webp|pdf|svg)$/i', $value) &&
                                (str_starts_with($value, 'blocks/') ||
                                 str_starts_with($value, 'hero-images/') ||
                                 str_starts_with($value, 'uploads/') ||
                                 str_starts_with($value, 'media/') ||
                                 preg_match('/^\w+\//', $value))) {
                                $blockIssues[] = [
                                    'field' => $fieldName,
                                    'type' => 'STRING',
                                    'value' => $value,
                                ];
                            }
                        }

                        // Check for UUID-keyed associative arrays
                        if (is_array($value) && !empty($value)) {
                            $keys = array_keys($value);

                            // Check if keys are UUIDs or not sequential integers
                            if ($keys !== range(0, count($value) - 1)) {
                                $firstKey = $keys[0] ?? null;

                                // UUID pattern check
                                if (is_string($firstKey) && preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $firstKey)) {
                                    $blockIssues[] = [
                                        'field' => $fieldName,
                                        'type' => 'UUID_KEYED_ARRAY',
                                        'value' => json_encode($value),
                                    ];
                                }
                            }
                        }
                    }

                    if (!empty($blockIssues)) {
                        $this->warn("  [{$locale}] Block: {$blockType} (index: {$blockIndex})");

                        foreach ($blockIssues as $issue) {
                            $issuesFound++;

                            if ($issue['type'] === 'STRING') {
                                $this->line("    ❌ {$issue['field']}: STRING - {$issue['value']}");
                            } elseif ($issue['type'] === 'UUID_KEYED_ARRAY') {
                                $this->line("    ❌ {$issue['field']}: UUID_KEYED_ARRAY - {$issue['value']}");
                            }
                        }

                        $this->newLine();
                    }
                }
            }
        }

        $this->newLine();

        if ($issuesFound > 0) {
            $this->error("Found {$issuesFound} potential FileUpload field issue(s)!");
            $this->info("Run 'php artisan pages:fix-all-blocks-uploads' to fix them.");
        } else {
            $this->info('✅ No issues found! All FileUpload fields are in the correct format.');
        }

        return Command::SUCCESS;
    }
}
