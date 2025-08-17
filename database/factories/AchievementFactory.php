<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Achievement>
     */
    protected $model = Achievement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $metricTypes = ['count', 'percentage', 'currency', 'decimal'];
        $periods = ['daily', 'weekly', 'monthly', 'quarterly', 'yearly'];
        $categories = ['Sales', 'Marketing', 'Operations', 'Customer Service', 'Technology', 'Growth'];
        $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#06B6D4', '#F97316'];
        
        $metricType = fake()->randomElement($metricTypes);
        $value = fake()->numberBetween(10, 1000);
        $targetValue = $value + fake()->numberBetween(50, 200);

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(8),
            'metric_type' => $metricType,
            'value' => $metricType === 'currency' ? fake()->randomFloat(2, 1000, 50000) : $value,
            'target_value' => $metricType === 'currency' ? fake()->randomFloat(2, 50000, 100000) : $targetValue,
            'unit' => match($metricType) {
                'currency' => '$',
                'percentage' => '%',
                'count' => '',
                'decimal' => ' pts',
                default => '',
            },
            'period' => fake()->randomElement($periods),
            'date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'category' => fake()->randomElement($categories),
            'color' => fake()->randomElement($colors),
            'is_active' => fake()->boolean(85),
        ];
    }
}