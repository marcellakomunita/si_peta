<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'book_id' => 'MbCjVDJshaxZAYfg',
                'user_id' => '2',
                'star' => '4',
                'review' => 'iniew 1 reveiwwwnaofnaw afss'
            ],
            [
                'book_id' => 'sQV3EL0YH0h1Vu6K',
                'user_id' => '2',
                'star' => '5',
                'review' => 'iniew 2 reveiwwwnaofnaw afss'
            ],
            [
                'book_id' => 'MbCjVDJshaxZAYfg',
                'user_id' => '2',
                'star' => '3',
                'review' => 'iniew 3 reveiwwwnaofnaw afss'
            ],
        ];

        foreach($reviews as $key => $review) {
            Review::create($review);
        }

    }
}
