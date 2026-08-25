<?php

namespace App\Observers;

use App\Models\Page;

class PageObserver
{
    protected array $fileFields = [
        'background_image',
        'hero_image',
        'image',
        'video_thumbnail',
        'timeline_image',
        'benefit_image',
        'small_image',
        'main_image',
        'timeline_1951_image',
        'timeline_2026_image',
        'promo_1_image',
        'promo_2_image',
        'promo_1_pdf',
        'promo_2_pdf',
    ];

    /**
     * Handle the Page "retrieved" event (when loaded from database).
     */
    public function retrieved(Page $page): void
    {
        $this->normalizeFileUploads($page);
    }

    /**
     * Handle the Page "saving" event (before saving to database).
     */
    public function saving(Page $page): void
    {
        $this->normalizeFileUploads($page);
    }

    /**
     * Normalize all FileUpload fields to indexed arrays.
     */
    protected function normalizeFileUploads(Page $page): void
    {
        foreach (['en', 'ar'] as $locale) {
            $blocks = $page->getTranslation('blocks', $locale, false) ?: [];

            // First, ensure blocks array itself is indexed (not UUID-keyed)
            if (! empty($blocks) && ! $this->isIndexedArray($blocks)) {
                $blocks = array_values($blocks);
            }

            $modified = false;

            foreach ($blocks as $key => $block) {
                if (! isset($block['data'])) {
                    continue;
                }

                foreach ($block['data'] as $field => $value) {
                    if (! in_array($field, $this->fileFields)) {
                        continue;
                    }

                    $normalized = $this->normalizeValue($value);
                    if ($normalized !== $value) {
                        $blocks[$key]['data'][$field] = $normalized;
                        $modified = true;
                    }
                }
            }

            if ($modified || ! $this->isIndexedArray($page->getTranslation('blocks', $locale, false) ?: [])) {
                $page->setTranslation('blocks', $locale, $blocks);
            }
        }
    }

    /**
     * Check if an array is indexed (has numeric sequential keys starting from 0).
     */
    protected function isIndexedArray(array $array): bool
    {
        if (empty($array)) {
            return true;
        }

        return array_keys($array) === range(0, count($array) - 1);
    }

    /**
     * Normalize a single file upload value.
     */
    protected function normalizeValue(mixed $value): mixed
    {
        // Empty values
        if (empty($value)) {
            return [];
        }

        // Already an indexed array with numeric keys
        if (is_array($value) && array_keys($value) === range(0, count($value) - 1)) {
            return $value;
        }

        // String - convert to array
        if (is_string($value)) {
            return [$value];
        }

        // Associative array (UUID-keyed) - convert to indexed
        if (is_array($value)) {
            $firstKey = array_key_first($value);
            if (is_string($firstKey) && strlen($firstKey) > 30) {
                return array_values($value);
            }
        }

        return $value;
    }
}
