<?php


namespace App\Filters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{

    public function status($status)
    {
        $this->where('status', $status);
    }

    public function speciality($id)
    {
        $this->related('info', 'speciality_id','=', $id);
    }

    public function city($id)
    {
        $this->related('info', 'city_id','=', $id);
    }

}
