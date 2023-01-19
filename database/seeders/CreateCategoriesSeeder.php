<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'=>'Fiksi',
                'img_icon'=> 'X',
            ],
            [
                'name'=>'Musik',
                'img_icon'=> 'X',
            ],
        ];
    
        foreach ($categories as $key => $category) {
            Category::create($category);
        }
    }
}
