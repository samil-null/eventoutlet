<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    private $cities = [
        [
            'name'  => 'Москва',
            'status' => 1
        ],
        [
            'name'  => 'Санкт-Петербург',
            'status' => 1
        ],
        [
            'name'  => 'Новосибирск',
            'status' => 1
        ],
        [
            'name'  => 'Екатеринбург',
            'status' => 1
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert($this->cities);
    }
}
