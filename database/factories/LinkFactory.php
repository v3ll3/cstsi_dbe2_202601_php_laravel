<?php

namespace Database\Factories;

use App\Models\Links;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Links>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
             "source" =>str_replace(
                'via.placeholder.com',
                'dummyimage.com',
                fake()->imageUrl(360, 360,'',true)
            )
        ];
    }
}
