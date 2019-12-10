<?php

use App\Models\PriceOption;
use Illuminate\Database\Seeder;

class PriceOptionsTableSeeder extends Seeder
{
    private $priceOptions = [
        [
            'name' => 'руб./ч.'
        ],
        [
            'name' => 'руб./день'
        ],
        [
            'name' => 'руб./шт.'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->priceOptions as $priceOption) {
            PriceOption::create($priceOption);
        }
    }
}
