<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public $services = [
        [
            'user_id' => 1,
            'name' => 'Фото на память',
            'price' => '1200',
            'price_option' => 'Фикс.',
            'description' => 'about text...'
        ],
        [
            'user_id' => 1,
            'name' => 'Свадебное фото',
            'price' => '1000',
            'price_option' => 'руб./ч.',
            'description' => 'about photo text...'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert($this->services);
    }
}
