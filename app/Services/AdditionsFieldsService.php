<?php


namespace App\Services;


use App\Models\AdditionFieldSpeciality;
use Illuminate\Support\Str;

class AdditionsFieldsService
{
    public function make($fields, $speciality)
    {
        $fields = collect($fields);

        $speciality->fields()->delete();
        $newFields = [];

        foreach ($fields as $field) {
            $newFields[] = new AdditionFieldSpeciality([
                'key' => $field['key']?$field['key']:Str::randLater(),
                'name' => $field['name']
            ]);
        }

        if (count($newFields)) {
            $speciality->fields()->saveMany($newFields);
        }
    }
}
