<?php

//use Str;
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
        User::create([
            'email' => 'denis@gmail.com',
            'password' => bcrypt('sosote20'),
            'api_token' => hash('sha256', Str::random(60))
        ]);
    }
}
