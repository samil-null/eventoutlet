<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    private $cities = [
        [
            'name'  => 'Москва'
        ],
        [
            'name'  => 'Санкт-Петербург'
        ],
        [
            'name'  => 'Новосибирск'
        ],
        [
            'name'  => 'Екатеринбург'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->cities as $city) {
            City::create($city);
        }
    }
}
