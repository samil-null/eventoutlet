<?php


namespace App\Transformers\Api\App;


use App\Helpers\DateHelper;
use App\Models\Offer;
use League\Fractal\TransformerAbstract;

class OfferTransformer extends TransformerAbstract
{
    public function transform(Offer $offer)
    {
        return [
            'id'                => (int) $offer->id,
            'service_name'      => (string) $offer->service->name,
            'description'       => (string) $offer->description,
            'discount'          => (string) $offer->discount,
            'dates'             => (string) DateHelper::displayRangeDates($offer->dates),
            'url'               => (string) route('site.lk.offers.edit', $offer->id),
            'price'             => (string) $offer->discount_price,
            'price_option'      => (string) $offer->service->priceOption->name,
            'status'            => (int) $offer->status,
            'status_name'       => (string) $offer->getStatus('name'),
            'has_disabled'      => (bool) $offer->hasDisabled() 
        ];
    }
}
