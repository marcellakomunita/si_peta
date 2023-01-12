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
                'name'=>'Admin User',
                'email'=>'admin@tutsmake.com',
                'phone'=>'08123131231',
                'type'=>1,
                'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'User',
                'email'=>'user@tutsmake.com',
                'phone'=>'18123131231',
                'type'=>0,
                'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}