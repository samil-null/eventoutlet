<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'executor',
            'display_name' => 'Исполнитель',
        ]);

//        DB::table('role_user')->insert([
//            'user_id' => 1,
//            'role_id' => 1,
//            'user_type' => 'App\Models\User::class'
//        ]);
    }
}
