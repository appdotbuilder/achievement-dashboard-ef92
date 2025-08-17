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
        Schema::create('presentations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Presentation title');
            $table->string('filename')->comment('Original filename');
            $table->string('file_path')->comment('Path to stored file');
            $table->string('file_type')->comment('File type (pptx, ppt, etc.)');
            $table->bigInteger('file_size')->comment('File size in bytes');
            $table->integer('total_slides')->default(0)->comment('Total number of slides');
            $table->enum('status', ['uploading', 'processing', 'ready', 'error'])->default('uploading')->comment('Processing status');
            $table->boolean('is_active')->default(true)->comment('Whether presentation is active');
            $table->string('thumbnail_path')->nullable()->comment('Path to thumbnail image');
            $table->json('metadata')->nullable()->comment('Additional metadata');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('user_id');
            $table->index('status');
            $table->index('is_active');
            $table->index(['user_id', 'is_active']);
            $table->index(['status', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentations');
    }
};