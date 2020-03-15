<?php

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    private $specialties = [
        [
            'name' => 'Фотограф',
            'seo_name' => 'Фотографа',
            'plural_name' => 'Фотографов',
            'status' => 1
        ],
        [
            'name' => 'Ведущий',
            'seo_name' => 'Ведущего',
            'plural_name' => 'Ведущих',
            'status' => 1,
        ],
        [
            'name' => 'Звукорежиссер',
            'seo_name' => 'Звукорежиссера',
            'plural_name' => 'Звукорежесеров',
            'status' => 1
        ],
        [
            'name' => 'Декоратор',
            'seo_name' => 'Декоратора',
            'plural_name' => 'Декораторов',
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
        Specialty::insert($this->specialties);
    }
}
