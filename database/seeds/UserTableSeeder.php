<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
                    'first_name'          =>  'User',
                    'last_name'           =>  'One',
                    'email'               =>  'user_one@gmail.com',
                    'password'            =>  Hash::make('123456'),
                    'password_updated_at' =>  \Carbon\Carbon::now(),
                ];

        User::firstOrCreate(['email' => $user['email']], $user);
    }
}
