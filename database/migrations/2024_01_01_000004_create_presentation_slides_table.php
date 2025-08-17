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
        Schema::create('presentation_slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presentation_id')->constrained()->onDelete('cascade');
            $table->integer('slide_number')->comment('Slide number in presentation');
            $table->string('title')->comment('Slide title');
            $table->longText('content')->nullable()->comment('Slide text content');
            $table->string('image_path')->nullable()->comment('Path to slide image');
            $table->string('image_url')->nullable()->comment('Public URL to slide image');
            $table->json('metadata')->nullable()->comment('Additional slide metadata');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('presentation_id');
            $table->index(['presentation_id', 'slide_number']);
            $table->unique(['presentation_id', 'slide_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentation_slides');
    }
};