<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = new User();
        $user->first_name = "Luis";
        $user->last_name = "Alcaras";
        $user->email = "luis.alcaras@cceo.com.mx";
        $user->password = bcrypt('secret');
        $user->save();
    }
}
