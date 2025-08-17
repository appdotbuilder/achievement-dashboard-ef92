<?php

namespace Database\Factories;

use App\Models\Presentation;
use App\Models\PresentationSlide;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PresentationSlide>
 */
class PresentationSlideFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\PresentationSlide>
     */
    protected $model = PresentationSlide::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'presentation_id' => Presentation::factory(),
            'slide_number' => 1,
            'title' => fake()->sentence(5),
            'content' => fake()->paragraphs(2, true),
            'image_path' => fake()->boolean(60) ? 'slides/' . fake()->word() . '.png' : null,
            'image_url' => fake()->boolean(60) ? fake()->imageUrl(800, 600) : null,
        ];
    }
}