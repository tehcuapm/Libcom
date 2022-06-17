<?php

namespace Database\Factories;

use App\Models\Category;
use Bezhanov\Faker\Provider\Commerce;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new Commerce($this->faker));
        return [
            "title" => $this->faker->productName(),
            "speech" => "un coussin",
            "stock" => $this->faker->randomNumber(2),
            "price" => $this->faker->randomNumber(2),
            "category_id" => Category::all()->random()->id,
            'created_at' => $this->faker->dateTimeThisMonth(),
            'updated_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
