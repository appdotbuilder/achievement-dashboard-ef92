<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'Monthly Sales Revenue',
                'description' => 'Total sales revenue for the current month',
                'metric_type' => 'currency',
                'value' => 125430.50,
                'target_value' => 150000.00,
                'unit' => '$',
                'period' => 'monthly',
                'date' => now()->toDateString(),
                'category' => 'Sales',
                'color' => '#3B82F6',
                'is_active' => true,
            ],
            [
                'title' => 'Customer Satisfaction Score',
                'description' => 'Average customer satisfaction rating',
                'metric_type' => 'percentage',
                'value' => 87.5,
                'target_value' => 90.0,
                'unit' => '%',
                'period' => 'weekly',
                'date' => now()->toDateString(),
                'category' => 'Customer Service',
                'color' => '#10B981',
                'is_active' => true,
            ],
            [
                'title' => 'Website Conversions',
                'description' => 'Number of website visitors that converted to customers',
                'metric_type' => 'count',
                'value' => 342,
                'target_value' => 400,
                'unit' => '',
                'period' => 'weekly',
                'date' => now()->toDateString(),
                'category' => 'Marketing',
                'color' => '#F59E0B',
                'is_active' => true,
            ],
            [
                'title' => 'Employee Productivity',
                'description' => 'Average tasks completed per employee per day',
                'metric_type' => 'decimal',
                'value' => 12.7,
                'target_value' => 15.0,
                'unit' => ' tasks',
                'period' => 'daily',
                'date' => now()->toDateString(),
                'category' => 'Operations',
                'color' => '#8B5CF6',
                'is_active' => true,
            ],
            [
                'title' => 'System Uptime',
                'description' => 'Percentage of time our systems were operational',
                'metric_type' => 'percentage',
                'value' => 99.9,
                'target_value' => 99.5,
                'unit' => '%',
                'period' => 'monthly',
                'date' => now()->subDay()->toDateString(),
                'category' => 'Technology',
                'color' => '#EF4444',
                'is_active' => true,
            ],
            [
                'title' => 'New User Registrations',
                'description' => 'Number of new users who signed up this week',
                'metric_type' => 'count',
                'value' => 156,
                'target_value' => 200,
                'unit' => ' users',
                'period' => 'weekly',
                'date' => now()->toDateString(),
                'category' => 'Growth',
                'color' => '#06B6D4',
                'is_active' => true,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }

        // Create some historical data
        for ($i = 1; $i <= 30; $i++) {
            Achievement::create([
                'title' => 'Daily Active Users',
                'description' => 'Number of users who logged in today',
                'metric_type' => 'count',
                'value' => random_int(800, 1200),
                'target_value' => 1000,
                'unit' => ' users',
                'period' => 'daily',
                'date' => now()->subDays($i)->toDateString(),
                'category' => 'Engagement',
                'color' => '#F97316',
                'is_active' => true,
            ]);
        }
    }
}