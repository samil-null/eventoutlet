<?php


namespace App\Services;

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
        $this->builder = User::with('offers', 'offersDates');
    }

    public function handle(Request $request)
    {
        return $this->apply($request->all());
    }

    private function apply($data)
    {
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

        $this->builder->whereHas('offersDates', function (Builder $query) use ($date) {
            $query->where('date', '>=', $date);
        });
    }

    public function date_to($value)
    {
        $date = $this->approveDate($value, 'to')->format(self::DATE_FORMAT);

        $this->builder->whereHas('offersDates', function (Builder $query) use ($date) {
            $query->where('date', '<=', $date);
        });
    }

    public function speciality($value)
    {
        $this->builder->where('speciality_id', $value);
        $this->builder->where('approved', 1);
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
