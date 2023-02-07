<?php

namespace Database\Seeders;

use App\Models\Jumbotron;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateJumbotronsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumbotrons = [
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
        
        foreach ($jumbotrons as $key => $jumbotron) {
            Jumbotron::create($jumbotron);
        }
    }
}
