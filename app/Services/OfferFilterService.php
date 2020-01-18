<?php


namespace App\Services;

use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class OfferFilterService
{

    private const DATE_FORMAT = 'Y-m-d';

    private $dateFrom;

    private $dateTo;

    private $builder;

    public function __construct()
    {
        $this->builder = User::with('offers.dates', 'info');
    }

    public function handle(Request $request)
    {
        return $this->apply($request->all());
    }

    private function apply($data)
    {
        $this->defaultFilter();

        foreach ($data as $name => $value) {
            if (method_exists($this, $name)) {
                $this->{$name}($value);
            }
        }

        return $this->builder;
    }

    public function date_from($value)
    {
        $date = $this->approveDate($value, 'from')->format(self::DATE_FORMAT);

        $this->builder->whereHas('offers.dates', function (Builder $query) use ($date) {
            $query->where('date', '>=', $date);
        });
    }

    public function date_to($value)
    {
        $date = $this->approveDate($value, 'to')->format(self::DATE_FORMAT);

        $this->builder->whereHas('offers.dates', function (Builder $query) use ($date) {
            $query->where('date', '<=', $date);
        });
    }

    public function speciality($value)
    {
        $this->builder->whereHas('info', function (Builder $query) use ($value) {
            $query->where('speciality_id', $value);
        });
    }

    public function special()
    {

    }

    private function defaultFilter()
    {
        $this->builder->where('approved', User::ACTIVE_STATUS);

        $this->builder->whereHas('offers', function (Builder $query) {
            $query->where('approved', Offer::ACTIVE_STATUS);
        });
    }

    private function approveDate($value, $side)
    {
        $now = Carbon::now();

        try {
            $date = Carbon::parse($value);
        } catch (\Exception $e) {
            if ($side == 'from') return Carbon::now();
            if ($side == 'to') return Carbon::now()->addDays(31);
        }


        if ($date->diffInDays($now, false) > 0 || $date->diffInDays($now, false) < -31) {
            if ($side == 'from') return Carbon::now();
            if ($side == 'to') return Carbon::now()->addDays(31);
        }

        return Carbon::now();
    }
}
