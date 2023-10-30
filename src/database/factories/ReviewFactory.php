<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reservation_id' => function () {
                return Reservation::inRandomOrder()->first()->id;
            },
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text(50),
        ];
    }
}
