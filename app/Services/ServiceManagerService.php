<?php


namespace App\Services;


use App\Models\AdditionFieldService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceManagerService
{
    private const MAX_SERVICES = 6;

    public function create($request)
    {
        $user = $request->user();
        $fields = $user->speciality->fields;
        $mappings = [];

        if ($fields->count()) {
            $mappings = $this->fillAdditionalFields($request->input('additional_fields'), $fields);
        }

        $service = $user->services()->save(
            new Service($request->only('name', 'price_option_id', 'price', 'description'))
        );

        $service->fields()->saveMany($mappings);

    }

    private function getAdditionalFields($service)
    {
        return $service->additionalFields;
    }


    public function fillAdditionalFields($additionalFields, $specialityFields)
    {
        $fieldsCollection = collect($additionalFields);

        $aFields = $fieldsCollection->sortBy('key')->pluck('key');
        $sFields = $specialityFields->sortBy('key')->pluck('key');

        $diff = $aFields->diff($sFields);

        if ($diff->count() == 0) {
            $mappings = $fieldsCollection->map(function ($item) {
                return new AdditionFieldService([
                    'fields_specialties_id' => $item['id'],
                    'value' => $item['value']
                ]);
            });

            return $mappings;
        } else {
            throw new \Exception('не все поля заполнены');
        }
    }

    public function update(Request $request, Service $service)
    {
        $service->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'price_option_id' => $request->input('price_option_id'),
        ]);
    }
}
