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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('level')->default(80); // 0-100 percentage
            $table->string('category')->default('Technical'); // Technical, Soft Skills, etc.
            $table->timestamps();
        });

        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('Backend'); // Backend, Frontend, DevOps, etc.
            $table->string('icon_class')->nullable(); // For FontAwesome icons
            $table->timestamps();
        });

        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('institution');
            $table->string('degree');
            $table->integer('year_from');
            $table->integer('year_to')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_info', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // email, phone, location, intro, etc.
            $table->text('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_info');
        Schema::dropIfExists('education');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('skills');
    }
};
