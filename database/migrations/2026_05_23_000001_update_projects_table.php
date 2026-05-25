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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('project_categories')->onDelete('set null');
            $table->string('project_type')->default('web_app'); // web_app, ml, cybersecurity, design, data_analysis, api
            $table->string('thumbnail')->nullable();
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('status')->default('completed'); // completed, in_progress, archived
            $table->text('short_description')->nullable();
            $table->json('technologies')->nullable(); // ['Laravel', 'React', 'TailwindCSS']
            
            // Update timestamps if they don't exist
            if (!Schema::hasColumn('projects', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeignIdFor('project_categories');
            $table->dropColumn([
                'category_id',
                'project_type',
                'thumbnail',
                'github_url',
                'live_url',
                'featured',
                'status',
                'short_description',
                'technologies'
            ]);
        });
    }
};
