<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CitiesSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            SpecialtiesTableSeeder::class,
            //PriceOptionsTableSeeder::class,
            ServicesTableSeeder::class
        ]);
    }
}
