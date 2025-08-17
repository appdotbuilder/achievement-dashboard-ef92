<?php

namespace Database\Factories;

use App\Models\DashboardContent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DashboardContent>
 */
class DashboardContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\DashboardContent>
     */
    protected $model = DashboardContent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contentTypes = ['text', 'announcement', 'image', 'html'];
        $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#06B6D4'];
        
        return [
            'title' => fake()->sentence(4),
            'content_type' => fake()->randomElement($contentTypes),
            'content' => fake()->paragraph(3),
            'display_order' => fake()->numberBetween(1, 10),
            'is_active' => fake()->boolean(80),
            'published_at' => fake()->dateTimeBetween('-7 days', 'now'),
            'expires_at' => fake()->boolean(30) ? fake()->dateTimeBetween('now', '+30 days') : null,
            'background_color' => fake()->randomElement($colors),
            'text_color' => '#FFFFFF',
        ];
    }
}