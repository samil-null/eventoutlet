<?php


namespace App\Factories\Algo;

use App\Models\City;
use App\Models\Media;
use App\Models\PriceOption;
use App\Models\Specialty;
use stdClass;
use App\Entities\Algo;

class AlgoFactory implements AlgoFactoryInterface
{

    protected $data;

    protected $ids;

    protected $gallery;

    protected $specialities;

    protected $cities;

    protected $priceOptions;

    protected $isSpecials;

    public function __construct()
    {
        $this->getSpecialities();
        $this->getPriceOptions();
        $this->getCities();
    }

    public function load($data, $isSpecials)
    {
        $this->data = $data;
        $this->isSpecials = $isSpecials;
        $this->ids = $data->pluck('id')->toArray();
        $this->getGallery();
        return $this;
    }

    public function create()
    {
        return $this->data->map(function ($item) {
            return $this->build($item);
        });
    }

    protected function getGallery()
    {
        $this->gallery = Media::whereIn('user_id', $this->ids)
            ->where('type','gallery')
            ->get(['name', 'user_id'])
            ->groupBy('user_id')
            ->toArray();
    }

    public function getSpecialities()
    {
        $specialities = (new Specialty())
            ->active()
            ->get(['name', 'id']);

        $this->specialities = $specialities->mapWithKeys(function ($item) {
            return [$item['id'] => $item];
        })
        ->toArray();
    }

    public function getCities()
    {
        $cities = (new City())
            ->active()
            ->get(['name', 'id']);

        $this->cities = $cities->mapWithKeys(function ($item) {
            return [$item['id'] => $item];
        })
        ->toArray();
    }

    public function getPriceOptions()
    {
       $this->priceOptions = PriceOption::all(['name', 'id'])
            ->mapWithKeys(function ($item) {
                return [$item['id'] => $item];
            })
            ->toArray();
    }

    public function build($data)
    {
        return new Algo(
            $data->id,
            $data->slug,
            $data->name,
            $data->avatar,
            $this->bindSpeciality($data->speciality_id),
            $this->bindOffer($data),
            $this->bindInfo($data),
            $this->bindGallery($data->id),
            $this->isSpecials,
            $data->service_price
        );
    }

    public function bindSpeciality($id)
    {
        return isset($this->specialities[$id])? $this->specialities[$id]['name']:'';
    }

    public function bindOffer($data)
    {
        $offer = new stdClass();
        $offer->discount = $data->discount??'';
        $offer->discount_price = $data->discount_price??'';
        $offer->price_option = $this->getPriceOption($data->price_option_id??null);

        return  $offer;
    }

    protected function getPriceOption($id)
    {
        return isset($this->priceOptions[$id])?$this->priceOptions[$id]['name']:'';
    }

    public function bindInfo($data)
    {
        $info = new stdClass();
        $info->instagram = $data->instagram;
        $info->email = $data->email;
        $info->whatsapp = $data->whatsapp;
        $info->phone = $data->phone;

        return $info;
    }
//
    public function bindGallery($id)
    {
        return isset($this->gallery[$id])?$this->gallery[$id]:[];
    }
}
