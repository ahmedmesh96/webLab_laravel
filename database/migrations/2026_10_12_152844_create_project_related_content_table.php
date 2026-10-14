<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_related_content', function (Blueprint $table) {
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('related_project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->primary(['project_id', 'related_project_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_related_content');
    }
};
