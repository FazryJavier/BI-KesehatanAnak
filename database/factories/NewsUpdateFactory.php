<?php

namespace Database\Factories;

use App\Enums\NewsCategory;
use App\Enums\NewsStatus;
use App\Models\NewsUpdate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NewsUpdate>
 */
class NewsUpdateFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => rtrim(fake()->sentence(6), '.'),
            'category' => NewsCategory::Announcement,
            'excerpt' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'status' => NewsStatus::Published,
            'published_at' => now()->subHour(),
            'is_featured' => false,
        ];
    }

    public function draft(): static
    {
        return $this->state(['status' => NewsStatus::Draft, 'published_at' => null]);
    }

    public function scheduled(): static
    {
        return $this->state(['status' => NewsStatus::Published, 'published_at' => now()->addDay()]);
    }
}
