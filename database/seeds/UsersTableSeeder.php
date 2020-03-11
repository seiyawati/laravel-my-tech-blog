<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Userモデルのオブジェクトを返している
        $user = User::where('email','seiya@gmail.com')->first();

        if(!$user){
        return User::create([
            'name' => 'seiya kawamoto',
            'email' => 'seiya@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('ufckid85')
         ]);
        }

    }
}
