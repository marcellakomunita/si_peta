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
                'category_id'=>'101',
                'isbn'=>'0789792220186',
                'judul'=>'Rahasia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'102',
                'isbn'=>'19789792220186',
                'judul'=>'Rah1sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'103',
                'isbn'=>'29789792220186',
                'judul'=>'Rah2sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'104',
                'isbn'=>'39789792220186',
                'judul'=>'Rah3sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'105',
                'isbn'=>'49789792220186',
                'judul'=>'Rah4sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'101',
                'isbn'=>'59789792220186',
                'judul'=>'Rah5sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(), 
                'category_id'=>'102', 
                'isbn'=>'69789792220186',
                'judul'=>'Rah6sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'103',
                'isbn'=>'79789792220186',
                'judul'=>'Rah7sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(), 
                'category_id'=>'104', 
                'isbn'=>'89789792220186',
                'judul'=>'Rah8sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'105',
                'isbn'=>'99789792220186',
                'judul'=>'Rah9sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'101',
                'isbn'=>'109789792220186',
                'judul'=>'Rah10sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'category_id'=>'102',
                'isbn'=>'119789792220186',
                'judul'=>'Rah11sia Bintang',
                'penulis'=>'Dyan Nuranindya',
                'penerbit'=>'Gramedia Pustaka Utama',
                'tgl_terbit'=>Carbon::create('2006', '03', '31')->toDateString(),
                'sinopsis'=>"Sejak ditinggal sahabatnya waktu kecil, Keysha nggak percaya lagi yang namanya sahabat. Baginya lebih baik mencari banyak teman daripada satu orang sahabat. Tapi semua berubah ketika dia mengenal Aji—cowok berandal, brengsek, tukang bikin onar, dan terkenal playboy di sekolah. Sejak mengenal Aji, setiap hari Keysha selalu jantungan menghadapi semua perilakunya yang gampang emosian. Apalagi ditambah musuh-musuh Aji yang jumlahnya bejibun. Keysha jadi merasa tidak aman dan terancam. Tapi bagaimana jadinya kalau ternyata cowok brengsek macam Aji justru menaruh kepercayaan besar pada Keysha sehingga ia berani menceritakan rahasianya yang paling dalam? Dan apa jadinya kalau orang seperti Aji akhirnya jatuh cinta pada Keysha?",
                'img_cover'=>'E:/hpics_cjpeb/pMdzCGbsxhphw80B.png',
                'file_ebook'=>'E:/hbooks_wrty/pMdzCGbsxhphw80B.pdf',
            ],
        ];
    
        foreach ($books as $key => $book) {
            Book::create($book);
        }
    }
}
