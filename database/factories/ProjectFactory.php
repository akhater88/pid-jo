<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titleEn = fake()->words(3, true);
        $titleAr = 'مشروع ' . fake()->company();

        return [
            // service_id must be provided when creating projects
            // Example: Project::factory()->create(['service_id' => 1])
            'title' => [
                'en' => ucfirst($titleEn),
                'ar' => $titleAr,
            ],
            'slug' => [
                'en' => \Illuminate\Support\Str::slug($titleEn),
                'ar' => \Illuminate\Support\Str::slug($titleAr),
            ],
            'customer_name' => [
                'en' => fake()->company(),
                'ar' => 'شركة ' . fake()->company(),
            ],
            'description' => [
                'en' => fake()->paragraphs(3, true),
                'ar' => 'وصف المشروع: ' . fake()->sentence(20),
            ],
            'published_at' => fake()->boolean(80) ? now()->subDays(fake()->numberBetween(1, 365)) : null,
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }
}
