<?php

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    private $specialties = [
        [
            'name' => 'Фотограф',
            'status' => 1
        ],
        [
            'name' => 'Ведущий',
            'status' => 1
        ],
        [
            'name' => 'Звукорежиссер',
            'status' => 1
        ],
        [
            'name' => 'Декоратор',
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
