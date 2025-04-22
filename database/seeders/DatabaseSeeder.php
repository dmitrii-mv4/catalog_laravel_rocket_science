<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CatalogCategory;
use App\Models\CatalogProductColor;
use App\Models\CatalogProduct;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = CatalogCategory::factory()
            ->count(8)
            ->sequence(
                ['title' => 'Люстры'],
                ['title' => 'Уличное освещение'],
                ['title' => 'Светильники'],
                ['title' => 'Настольные лампы'],
                ['title' => 'Светильники для детской'],
                ['title' => 'Мебельные светильники'],
                ['title' => 'Комплектующие'],
                ['title' => 'Комплектующие'],
            )
            ->create();

        $colors = CatalogProductColor::factory()
            ->count(8)
            ->sequence(
                ['title' => 'Белый'],
                ['title' => 'Чёрный'],
                ['title' => 'Красный'],
                ['title' => 'Синий'],
                ['title' => 'Жёлтый'],
            )
            ->create();

        $products = CatalogProduct::factory(100)->create();

        foreach ($products as $product) {
            $colorsId = $colors->random(5)->pluck('id');
            $product->colors()->attach($colorsId);
        }
    }
}
