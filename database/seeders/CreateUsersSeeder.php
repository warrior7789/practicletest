<?php

namespace Database\Seeders;

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
        //
        $user = [
                    [
                       'name'=>'Admin',
                       'email'=>'mahesh@admin.com',
                        'is_admin'=>'1',
                       'password'=> bcrypt('lloyd@321'),
                    ],
                    [
                       'name'=>'User',
                       'email'=>'mahesh@normal.com',
                        'is_admin'=>'0',
                       'password'=> bcrypt('lloyd@321'),
                    ],
                ];
          
                foreach ($user as $key => $value) {
                    User::create($value);
                }
    }
}
