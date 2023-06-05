<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            [
                'name' => 'Dyan Nuranindya'
            ],
            [
                'name' => 'Eliz Ran'
            ],
        ];

        foreach($authors as $key => $author) {
            Author::create($author);
        }
    }
}
