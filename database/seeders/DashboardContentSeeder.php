<?php

namespace Database\Seeders;

use App\Models\DashboardContent;
use Illuminate\Database\Seeder;

class DashboardContentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $contents = [
            [
                'title' => 'Welcome Message',
                'content_type' => 'announcement',
                'content' => 'Welcome to our new dashboard system! 🎉 Here you can track achievements, view presentations, and manage dynamic content all in one place.',
                'display_order' => 1,
                'is_active' => true,
                'published_at' => now(),
                'background_color' => '#3B82F6',
                'text_color' => '#FFFFFF',
            ],
            [
                'title' => 'Team Meeting Reminder',
                'content_type' => 'announcement',
                'content' => '📅 Don\'t forget about our weekly team meeting tomorrow at 2:00 PM in the conference room. We\'ll be discussing Q4 planning and upcoming projects.',
                'display_order' => 2,
                'is_active' => true,
                'published_at' => now(),
                'background_color' => '#F59E0B',
                'text_color' => '#FFFFFF',
            ],
            [
                'title' => 'System Maintenance Notice',
                'content_type' => 'announcement',
                'content' => '🔧 Scheduled maintenance will occur this weekend from 2:00 AM to 4:00 AM EST. Some services may be temporarily unavailable during this time.',
                'display_order' => 3,
                'is_active' => true,
                'published_at' => now(),
                'expires_at' => now()->addDays(7),
                'background_color' => '#EF4444',
                'text_color' => '#FFFFFF',
            ],
            [
                'title' => 'Performance Highlights',
                'content_type' => 'text',
                'content' => '🏆 Great job team! We\'ve exceeded our monthly sales target by 15% and maintained a 98.5% customer satisfaction rating.',
                'display_order' => 4,
                'is_active' => true,
                'published_at' => now(),
                'background_color' => '#10B981',
                'text_color' => '#FFFFFF',
            ],
            [
                'title' => 'New Feature Release',
                'content_type' => 'announcement',
                'content' => '🚀 We\'ve just released the new presentation viewer! You can now upload PowerPoint files and display them as interactive slides.',
                'display_order' => 5,
                'is_active' => true,
                'published_at' => now(),
                'background_color' => '#8B5CF6',
                'text_color' => '#FFFFFF',
            ],
            [
                'title' => 'Data Sync Status',
                'content_type' => 'text',
                'content' => '🔄 All OneDrive spreadsheets are syncing successfully. Last sync: 5 minutes ago. Next scheduled sync: in 25 minutes.',
                'display_order' => 6,
                'is_active' => true,
                'published_at' => now(),
                'background_color' => '#06B6D4',
                'text_color' => '#FFFFFF',
            ],
        ];

        foreach ($contents as $content) {
            DashboardContent::create($content);
        }
    }
}