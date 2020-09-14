<?php

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    private $specialties = [
        [
            'name' => 'Фотограф',
            'slug'  => 'slug-1',
            'seo_name' => 'Фотографа',
            'plural_name' => 'Фотографов',
            'status' => 1
        ],
        [
            'name' => 'Ведущий',
            'slug'  => 'slug-2',
            'seo_name' => 'Ведущего',
            'plural_name' => 'Ведущих',
            'status' => 1,
        ],
        [
            'name' => 'Звукорежиссер',
            'slug'  => 'slug-3',
            'seo_name' => 'Звукорежиссера',
            'plural_name' => 'Звукорежесеров',
            'status' => 1
        ],
        [
            'name' => 'Декоратор',
            'slug'  => 'slug-4',
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
