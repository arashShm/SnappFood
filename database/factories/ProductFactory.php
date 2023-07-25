<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{


    public function definition(): array
    {
        return [
            'title' => $this->faker->text(20),
            'shop_id' =>$this->faker->numberBetween(27,28),
            'price' => $this->faker->numberBetween(1,100)*1000 ,
            'discount' => $this->faker->numberBetween(0,5)*5 ,
            'description' => $this->faker->paragraph(50),
            'created_at' =>$this->faker->dateTimeThisMonth()->format('Y-m-d'),
            'updated_at' =>$this->faker->dateTimeThisMonth()->format('Y-m-d')
        ];
    }
}
