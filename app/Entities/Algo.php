<?php


namespace App\Entities;


class Algo
{
    public $id;

    public $name;

    public $avatar;

    public $speciality;

    public $offer;

    public $info;

    public $gallery;

    public $isSpecials;

    public $service_price;

    public $slug;

    public function __construct($id = '', $slug = '', $name = '', $avatar = '', $speciality = '', $offer = '', $info ='', $gallery = '', $isSpecials = false, $servicePrice = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->avatar = $avatar;
        $this->speciality = $speciality;
        $this->offer = $offer;
        $this->info = $info;
        $this->gallery = $gallery;
        $this->isSpecials = $isSpecials;
        $this->service_price = $servicePrice;
    }
}

