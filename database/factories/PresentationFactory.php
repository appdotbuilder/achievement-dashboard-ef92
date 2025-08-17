<?php

namespace Database\Factories;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presentation>
 */
class PresentationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Presentation>
     */
    protected $model = Presentation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['ready', 'processing', 'uploading', 'error'];
        $filename = fake()->word() . '_presentation.pptx';
        
        return [
            'title' => fake()->sentence(4),
            'filename' => $filename,
            'file_path' => 'presentations/' . $filename,
            'file_type' => 'pptx',
            'file_size' => fake()->numberBetween(500000, 50000000), // 0.5MB to 50MB
            'total_slides' => fake()->numberBetween(5, 50),
            'status' => fake()->randomElement($statuses),
            'is_active' => fake()->boolean(85),
            'user_id' => User::factory(),
        ];
    }
}