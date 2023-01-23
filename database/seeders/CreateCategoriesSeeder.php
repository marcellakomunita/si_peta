<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("ALTER TABLE categories AUTO_INCREMENT = 100;");

        $categories = [
            [
                'name'=>'Agama',
                'img_icon'=> 'agama.png',
            ],
            [
                'name'=>'Agama Islam',
                'img_icon'=> 'agama_islam.png',
            ],
            [
                'name'=>'Bahasa & Sastra',
                'img_icon'=> 'bahasa_sastra.png',
            ],
            [
                'name'=>'Biografi',
                'img_icon'=> 'biografi.png',
            ],
            [
                'name'=>'Budidaya',
                'img_icon'=> 'budidaya.png',
            ],
            [
                'name'=>'Buku Anak',
                'img_icon'=> 'buku_anak.png',
            ],
            [
                'name'=>'Desain',
                'img_icon'=> 'desain.png',
            ],
            [
                'name'=>'Ekonomi',
                'img_icon'=> 'ekonomi.png',
            ],
            [
                'name'=>'Fiksi',
                'img_icon'=> 'fiksi.png',
            ],
            [
                'name'=>'Hukum',
                'img_icon'=> 'hukum.png',
            ],
            [
                'name'=>'Humor',
                'img_icon'=> 'humor.png',
            ],
            [
                'name'=>'Kamus',
                'img_icon'=> 'kamus.png',
            ],
            [
                'name'=>'Kesehatan',
                'img_icon'=> 'kesehatan.png',
            ],
            [
                'name'=>'Keterampilan',
                'img_icon'=> 'keterampilan.png',
            ],
            [
                'name'=>'Komik',
                'img_icon'=> 'komik.png',
            ],
            [
                'name'=>'Novel',
                'img_icon'=> 'novel.png',
            ],
            [
                'name'=>'Pandemi',
                'img_icon'=> 'pandemi.png',
            ],
            [
                'name'=>'Pendidikan',
                'img_icon'=> 'pendidikan.png',
            ],
            [
                'name'=>'Resep',
                'img_icon'=> 'resep.png',
            ],
            [
                'name'=>'Sains & Akademik',
                'img_icon'=> 'sains_akademik.png',
            ],
            [
                'name'=>'Sastra & Budaya',
                'img_icon'=> 'sastra_budaya.png',
            ],
            [
                'name'=>'Sejarah',
                'img_icon'=> 'sejarah.png',
            ],
            [
                'name'=>'Teknik',
                'img_icon'=> 'teknik.png',
            ],
            [
                'name'=>'Teknologi',
                'img_icon'=> 'teknologi.png',
            ],
            [
                'name'=>'Teknologi & Komputer',
                'img_icon'=> 'teknologi_komputer.png',
            ],
            [
                'name'=>'Umum',
                'img_icon'=> 'umum.png',
            ],
            [
                'name'=>'Wirausaha',
                'img_icon'=> 'wirausaha.png',
            ],
        ];
    
        foreach ($categories as $key => $category) {
            Category::create($category);
        }
    }
}
