<?php

namespace Database\Seeders;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'isbn'=>'9789792220186',
                'judul'=>'Rahasia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'1',
                'file_ebook'=>'1',
            ],
        ];
    
        foreach ($books as $key => $book) {
            Book::create($book);
        }
    }
}
