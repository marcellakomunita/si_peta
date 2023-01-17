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
        // $value = unpack('H*', "Stack");
        // echo base_convert($value[1], 16, 2);
        $users = [
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
                'name'=>'Admin User',
                'email'=>'admin@tutsmake.com',
                'phone'=>'08123131231',
                'type'=>1,
                'password'=> bcrypt('123456'),
            ],
            [
                // 'id'=>\Ramsey\Uuid\Uuid::uuid4()->getBytes(),  
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