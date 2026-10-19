<?php

namespace Database\Factories;

use App\Models\LookerStudio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LookerStudio>
 */
class LookerStudioFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return ['url' => 'https://lookerstudio.google.com/embed/reporting/'.fake()->uuid().'/page/'.fake()->lexify('????')];
    }
}
