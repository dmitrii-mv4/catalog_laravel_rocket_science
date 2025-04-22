<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CatalogCategory;
use App\Models\CatalogProduct;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CatalogProduct>
 */
class CatalogProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(20),
            'slug' => $this->faker->text,
            'artikul' => 'ARTICUL_TOVAR_' . random_int(1, 10000),
            'price' => random_int(1, 10000),
            'old_price' => random_int(1, 10000),
            'image' => $this->faker->imageUrl(),
            'category_id' => CatalogCategory::get()->random()->id
        ];
    }
}
