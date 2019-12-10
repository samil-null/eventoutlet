<?php

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    private $specialties = [
        [
            'name' => 'Фотограф',
            'is_active' => 1
        ],
        [
            'name' => 'Ведущий',
            'is_active' => 1
        ],
        [
            'name' => 'Звукорежиссер',
            'is_active' => 1
        ],
        [
            'name' => 'Декоратор',
            'is_active' => 1
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
