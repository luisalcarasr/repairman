<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = "Luis";
        $user->last_name = "Alcaras";
        $user->email = "luisalcarasr@gmail.com";
        $user->password = bcrypt('secret');
        $user->save();
        $user->assignRole('admin');
    }
}
