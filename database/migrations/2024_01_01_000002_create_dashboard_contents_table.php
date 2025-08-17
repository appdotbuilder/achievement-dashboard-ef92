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
        Schema::create('dashboard_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Content title');
            $table->string('content_type')->comment('Type of content (text, image, video, html, announcement)');
            $table->longText('content')->nullable()->comment('Text content or HTML markup');
            $table->string('media_url')->nullable()->comment('URL for media files');
            $table->string('media_type')->nullable()->comment('MIME type of media file');
            $table->integer('display_order')->default(0)->comment('Display order on dashboard');
            $table->boolean('is_active')->default(true)->comment('Whether content is active');
            $table->timestamp('published_at')->nullable()->comment('When content should be published');
            $table->timestamp('expires_at')->nullable()->comment('When content should expire');
            $table->string('background_color')->nullable()->comment('Background color for content block');
            $table->string('text_color')->nullable()->comment('Text color for content block');
            $table->json('metadata')->nullable()->comment('Additional metadata for content');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('content_type');
            $table->index('is_active');
            $table->index('published_at');
            $table->index('expires_at');
            $table->index(['is_active', 'display_order']);
            $table->index(['published_at', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_contents');
    }
};