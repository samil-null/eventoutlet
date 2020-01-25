<?php


namespace App\Services;

use App\Models\Offer;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OfferFilterService
{
    public function apply(Request $request)
    {

    }

    public function case()
    {
        $data = DB::table('users')->where('users.status', User::ACTIVE_STATUS)
            ->join('services', function ($query) {
                $query->on('users.id', '=', 'services.user_id')
                    ->where('services.status', Service::ACTIVE_STATUS);
            })
            ->join('offers', function ($query) {
                $query->on('services.id', '=', 'offers.service_id')
                    ->where('offers.status', Offer::ACTIVE_STATUS);
            })
            ->join('offers_dates', function ($query) {
                $query->on('offers.id', '=', 'offers_dates.offer_id');
            })
            ->join('users_info', 'users.id', 'users_info.user_id')
            ->where('offers.discount','>=', 50)
            ->where('offers_dates.date', '>=', '2020-01-30')
            ->groupBy('users.id')
            //->select('offers.id');

//                $agregate = DB::table(DB::raw("({$data->toSql()}) as sub"))->select(
//                    DB::raw('sub')
//                );
//                $agregate = DB::table('offers')->whereRaw("id in ({$data->toSql()})")
//                    ->select(DB::raw('max(discount) as max_discount, min(discount) as min_discount,
//                                max(discount_price) as max_price, min(discount_price) as min_price'));
//                $agregate->mergeBindings( $data );
//
//                dd($agregate->first());
            ->select(
                'users.name','users.id', 'users.avatar', 'services.user_id',
                'services.name as service_name', 'services.id as service_id', 'services.price_option_id',
                'users_info.instagram','offers.discount','offers.discount_price',
                'users_info.speciality_id','users_info.whatsapp', 'users_info.email', 'users_info.phone'
            );
    }
}
