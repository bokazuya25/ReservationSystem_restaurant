<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
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
            'user_id' => User::whereNotIn('id',[1,2])->inRandomOrder()->first()->id,
            'shop_id' => Shop::inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text(50),
        ];
    }
}
