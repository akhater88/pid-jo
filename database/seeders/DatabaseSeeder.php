<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user from .env credentials
        $this->call([
            AdminUserSeeder::class,
            ServiceSeeder::class,
            BlogPostSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            GallerySeeder::class,
            HomePageSeeder::class,
        ]);
    }
}
