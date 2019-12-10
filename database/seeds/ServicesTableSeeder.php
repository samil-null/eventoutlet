<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public $services = [
        [
            [
                'user_id' => 1,
                'price_option_id' => 1,
                'name' => 'Фото на память',
                'price' => 1200,
                'description' => 'about text...'
            ],
            [
                'user_id' => 1,
                'price_option_id' => 3,
                'name' => 'Свадебное фото',
                'price' => 1000,
                'description' => 'about photo text...'
            ]
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}
