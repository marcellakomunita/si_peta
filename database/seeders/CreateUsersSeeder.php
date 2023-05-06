<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
  
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'name'=>'Admin SIPETA',
                'email'=>'admin@sipeta.com',
                'phone'=>'08123131231',
                'type'=>1,
                'password'=> bcrypt('123qweasd'),
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'name'=>'Teddy',
                'email'=>'teddy@mil.com',
                'phone'=>'18123131231',
                'type'=>0,
                'password'=> bcrypt('123qweasd'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}