<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Khsing\World\Models\Continent;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $europe = Continent::getByName("Europe");
        $user = User::all()->random();
        return [
            'order_date' => $this->faker->dateTimeThisMonth(),
            'address_id' => $user->addresses->random(),
            'user_id' => $user->id,
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth(),


        ];
    }
}
