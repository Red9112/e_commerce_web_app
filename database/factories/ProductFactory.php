<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{ 
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shops=Shop::all();
        $categories=Category::all();

        return [
            'name' => $this->faker->name(),
            'sku' => $this->faker->unique()->uuid(),
            'qty_in_stock' => $this->faker->biasedNumberBetween(5,100),
            'price' => $this->faker->randomNumber(4), 
            'description' => $this->faker->text(500), 
            'shop_id' =>  $this->faker->randomElement($shops),
            'created_at'=>$this->faker->dateTimeBetween('-3 months'),
        ];
    }
}
