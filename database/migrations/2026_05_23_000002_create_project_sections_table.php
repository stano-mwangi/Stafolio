<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->enum('section_type', [
                'text',
                'image',
                'gallery',
                'code',
                'notebook_step',
                'metrics',
                'visualization',
                'timeline',
                'embedded_video',
                'features'
            ])->default('text');
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable(); // Single image path
            $table->json('gallery')->nullable(); // Multiple images for gallery
            $table->json('metadata')->nullable(); // Additional data (metrics, code language, etc.)
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_sections');
    }
};
