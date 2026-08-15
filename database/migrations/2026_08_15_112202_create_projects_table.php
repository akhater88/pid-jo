<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->json('title');             // {"en": "Kitchen Renovation", "ar": "تجديد المطبخ"}
            $table->json('slug');              // {"en": "kitchen-renovation", "ar": "تجديد-المطبخ"}
            $table->json('customer_name');     // {"en": "ABC Company", "ar": "شركة ABC"}
            $table->json('description');       // {"en": "Description...", "ar": "الوصف..."}
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
