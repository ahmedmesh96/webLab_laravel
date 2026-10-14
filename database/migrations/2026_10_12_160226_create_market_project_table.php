<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('market_project', function (Blueprint $table) {
            $table->foreignId('market_id')
                ->constrained('markets')
                ->cascadeOnDelete();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->primary(['market_id', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('market_project');
    }
};
