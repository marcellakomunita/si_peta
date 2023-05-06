<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'img_slide' => '1.png'
            ],
            [
                'img_slide' => '2.png'
            ],
            [
                'img_slide' => '3.png'
            ]
        ];
        
        foreach ($sliders as $key => $slider) {
            Slider::create($slider);
        }
    }
}
