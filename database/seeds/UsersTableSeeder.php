<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
          'name' => 'Taro Yamada',
          'email' => 'a@a',
          'password' => str_random(60),
        ]);
        $user->save();
    }
}
