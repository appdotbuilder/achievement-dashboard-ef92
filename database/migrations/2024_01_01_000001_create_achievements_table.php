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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Achievement title or name');
            $table->text('description')->comment('Detailed description of the achievement');
            $table->string('metric_type')->comment('Type of metric (count, percentage, currency, etc.)');
            $table->decimal('value', 12, 2)->comment('Current achievement value');
            $table->decimal('target_value', 12, 2)->nullable()->comment('Target value for the achievement');
            $table->string('unit')->nullable()->comment('Unit of measurement (%, $, pieces, etc.)');
            $table->string('period')->comment('Time period (daily, weekly, monthly, yearly)');
            $table->date('date')->comment('Date this achievement data is for');
            $table->string('category')->nullable()->comment('Achievement category for grouping');
            $table->string('color')->nullable()->comment('Color code for chart display');
            $table->boolean('is_active')->default(true)->comment('Whether this achievement is active');
            $table->string('onedrive_sheet_id')->nullable()->comment('OneDrive spreadsheet ID for sync');
            $table->string('onedrive_range')->nullable()->comment('Cell range in OneDrive sheet');
            $table->timestamp('last_synced_at')->nullable()->comment('Last sync with OneDrive');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('date');
            $table->index('category');
            $table->index('is_active');
            $table->index(['category', 'date']);
            $table->index(['is_active', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};