<?php


namespace App\Filters;

use App\Models\Offer;
use App\Models\Service;
use App\Models\User;
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

    public function requireModeration($value)
    {
        $usersOffers = User::whereHas('offers', function ($query) {
            $query->where('offers.status', Offer::WAITING_STATUS);
        })->get('id');

        $usersServices = User::whereHas('services', function ($query) {
            $query->where('services.status', Service::WAIT_STATUS);
        })->get('id');



        $ids = $usersOffers->pluck('id');
        $ids->merge($usersServices->pluck('id'));

        $this->whereIn('id', $ids->toArray());

        $this->orWhere('users.status', '!=', User::ACTIVE_STATUS);
    }

    public function servicesStatus($status)
    {
        $this->related('services', 'status','=', $status);
    }

    public function offersStatus($status)
    {
        $this->related('services.offers', 'status','=', $status);
    }

    public function search($query)
    {
        $connection = \DB::connection('sphinx');
        $userIds = $connection->table('idx_users_name')
            ->match('name', $query);

        $this->orWhere('users.name', 'LIKE', "%{$query}%");
        $this->orWhereIn('users.id', $userIds->get('id')->pluck('id'));
    }
}
