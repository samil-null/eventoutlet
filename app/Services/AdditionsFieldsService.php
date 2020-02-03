<?php


namespace App\Services;


use App\Models\Speciality;
use App\Models\AdditionFieldSpeciality;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdditionsFieldsService
{
    protected $builder;

    protected $serviceBuilder;

    public function make($fields, $speciality)
    {
        $this->getAdditionsFieldsQuery($speciality->id);

        if (isset($fields['exist'])) {
            $existFields = collect($fields['exist']);

            // удаляем удаленные поля
            $speciality->fields()->whereNotIn('id', $existFields->keys())->delete();

            // удаляем эти поля у пользователя
            $this->builder->whereNotIn('speciality_field_id', $existFields->keys())->delete();
            // обновляем старые поля
            foreach ($existFields as $id => $value) {
                $speciality->fields()->find($id)
                    ->update([
                        'name' => $value
                    ]);
            }
        } else {
            $this->builder->delete();
            $speciality->fields()->delete();
        }

        if (isset($fields['new'])) {

            foreach ($fields['new'] as $field) {
                $newSpeciality = $speciality->fields()->save(
                    new AdditionFieldSpeciality(['name' => $field])
                );

                $this->createAdditionFields($this->serviceBuilder, $newSpeciality->id);
            }
//            $newFields = collect($fields['new']);
//            dd($newFields);
//            $newFieldsRecords = $newFields->map(function ($field) {
//                return new AdditionFieldSpeciality(['name' => $field]);
//            });

            //$speciality->fields()->saveMany($newFieldsRecords);
        }
    }

    protected function getAdditionsFieldsQuery($specialityId)
    {
        $servicesBuilder =  DB::table('services')
            ->join('users','services.user_id', '=', 'users.id')
            ->join('users_info', 'users.id', '=', 'users_info.user_id')
            ->where('users_info.speciality_id','=', $specialityId)
            ->groupBy('services.id');

        $servicesBuilder->select('services.id');
        $this->serviceBuilder = $servicesBuilder;
        $additionsFieldsQuery = DB::table('additional_fields_services')->whereRaw("service_id in ({$servicesBuilder->toSql()})");
        $additionsFieldsQuery->mergeBindings( $servicesBuilder );

        if (!$this->builder) {
            $this->builder = $additionsFieldsQuery;
        }

        return $this->builder;
    }

    public function createAdditionFields(Builder $builder, $fieldId)
    {
        $builder->addSelect(DB::raw($fieldId));
        $bindings = $builder->getBindings();
        $query = "INSERT INTO `additional_fields_services` (`service_id`, `speciality_field_id` )" . $builder->toSql();

        DB::insert($query, $bindings);
    }
}
