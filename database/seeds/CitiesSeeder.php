<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    private $cities = [
        [
            'name'  => 'Москва',
            'seo_name' => 'Москве',
            'status' => 1
        ],
        [
            'name'  => 'Санкт-Петербург',
            'seo_name' => 'Санкт-Петербурге',
            'status' => 1
        ],
        [
            'name'  => 'Новосибирск',
            'seo_name' => 'Новосибирске',
            'status' => 1
        ],
        [
            'name'  => 'Екатеринбург',
            'seo_name' => 'Екатеринбурге',
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
