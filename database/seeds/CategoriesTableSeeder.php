<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Actualité',
        ]);
        Category::create([
            'name' => 'Politique',
        ]);
        Category::create([
            'name' => 'Sport',
        ]);
        Category::create([
            'name' => 'Numérique',
        ]);
        Category::create([
            'name' => 'Diver',
        ]);
    }
}