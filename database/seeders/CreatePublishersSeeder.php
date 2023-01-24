<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePublishersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $publishers = [
            [
                'name' => 'Gramedia Elex Komputindo'
            ],
            [
                'name' => 'Gramedia Pustaka Utama'
            ],
        ];

        foreach($publishers as $key => $publisher) {
            Publisher::create($publisher);
        }
    }
}
