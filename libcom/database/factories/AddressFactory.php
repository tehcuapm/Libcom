<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Khsing\World\Models\Continent;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $europe = Continent::getByName("Europe");
        return [
            'order_address' => $this->faker->address(),
            'country' => $europe->children()->random()->name,
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth(),
            'user_id' => 'overriden',


        ];
    }
}
