<?php


namespace App\Factories\Offer;


use App\Entities\Offer;
use App\Helpers\DateHelper;
use Illuminate\Support\Collection;

class OfferFactory
{
    public $offers;


    public function __construct(Collection $offers)
    {
        $this->offers = $offers;
    }

    public function create()
    {
        return $this->mapping();
    }

    public function mapping()
    {
        return $this->offers->map(function ($offer) {
            return new Offer(
                $offer->id,
                $offer->service->name,
                $offer->description,
                DateHelper::displayRangeDates($offer->dates),
                DateHelper::flatDate($offer->dates),
                $offer->discount_price,
                $offer->discount,
                $offer->service->priceOption->name,
                route('site.lk.offers.edit', $offer->id),
                $offer->status
            );
        });

    }
}
