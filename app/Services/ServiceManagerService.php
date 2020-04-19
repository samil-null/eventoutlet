<?php


namespace App\Services;


use App\Exceptions\AdditionFieldValidateException;
use App\Models\AdditionFieldService;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class ServiceManagerService
{
    private const MAX_SERVICES = 6;

    protected $requestFieldsRules = [
        'value' => 'integer|required'
    ];

    protected $requestFieldsValidationErrorsMessages = [
        'integer' => 'Значение может быть только числовым',
        'required' => 'Поле обязательно для заполнения'
    ];

    public function create($request, $user)
    {
        $fields = $user->speciality->fields;

        if ($user->services()->count() >= self::MAX_SERVICES) {
            throw new \Exception('max limit services', 422);
        }

        $additionFields = [];

        if ($fields->count()) {
            $additionFields = $this->createAdditionFields(collect($request->input('additional_fields')), $fields);
        }

        $service = $user->services()->create([
            'name' => $request->name,
            'price_option_id' => $request->price_option_id,
            'price' => $request->price,
            'description' => $request->description,
            'status' => Offer::WAITING_STATUS
        ]);

        if (count($additionFields)) {
            $service->fields()->saveMany($additionFields);
        }

        return $service;
    }

    public function createAdditionFields(Collection $requestFields, $specialityFields)
    {
        $result = [];
        $errors = [];
        foreach ($specialityFields as $field) {

            if ($requestFields->contains('id', $field->id)) {
                $requestAdditionField = $requestFields->where('id', $field->id)->first();

                 $validateError = Validator::make($requestAdditionField, $this->requestFieldsRules,$this->requestFieldsValidationErrorsMessages)
                 ->errors();

                 if ($validateError->count()) {
                     $errors[$field->id] = $validateError->messages()['value'];
                 }

                 $result[] = new AdditionFieldService([
                     'value' => $requestAdditionField['value'],
                     'speciality_field_id' => $requestAdditionField['id']
                 ]);
            } else {
               throw new \Exception('not required field', 422);
            }
        }

        if (count($errors)) {
            throw new AdditionFieldValidateException($errors);
        }

        return $result;
    }

    public function updateAdditionFields(Collection $requestFields, $specialityFields, $service)
    {
        foreach ($specialityFields as $field) {

            if ($requestFields->contains('id', $field->id)) {
                $requestAdditionField = $requestFields->where('id', $field->id)->first();
                Validator::make($requestAdditionField, $this->requestFieldsRules,$this->requestFieldsValidationErrorsMessages)
                    ->validate();

                if (is_numeric($requestAdditionField['fId'])) {
                    $service->fields()
                        ->where('id', $requestAdditionField['fId'])
                        ->update([
                            'value' => $requestAdditionField['value']
                        ]);
                } else {
                    $service->fields()->create([
                        'value' => $requestAdditionField['value'],
                        'speciality_field_id' => $field->id
                    ]);
                }

            } else {
                throw new \Exception('not required field', 422);
            }
        }
    }

    public function update(Request $request, Service $service)
    {
        $user = $request->user();
        $fields = $user->speciality->fields;
        $this->updateAdditionFields(collect($request->input('additional_fields')), $fields, $service);
        $service->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'status' => Service::WAIT_STATUS,
            'price_option_id' => $request->input('price_option_id'),
        ]);

        $service->offers->map(function ($offer) {
            $offer->calculateDiscountPrice();
            $offer->save();
        });
    }
}
