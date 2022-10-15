<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

namespace Constlapkin\Reviews\Database\Factories;

use Constlapkin\Reviews\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'product_id' => 1,
            'published_at' => now(),
            'comment' => $this->faker->paragraph,
            'score' => $this->faker->randomNumber(),
        ];
    }
}
