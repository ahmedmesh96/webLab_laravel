<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Basic information
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt', 500)->nullable();
            $table->longText('content')->nullable();

            // Media and SEO
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Publishing
            $table->string('status')->default('draft');
            $table->string('locale', 5)->default('en');
            $table->timestamp('published_at')->nullable();

            // Relationships
            $table->foreignId('author_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index('locale');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
