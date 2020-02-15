<?php


namespace App\Entities;


class Offer
{
    public $serviceName;

    public $description;

    public $dates;

    public $price;

    public $discount;

    public $priceOption;

    public $editUrl;

    public $status;

    public function __construct($serviceName, $description, $dates, $price, $discount, $priceOption, $editUrl, $status)
    {
        $this->serviceName = $serviceName;
        $this->description = $description;
        $this->dates = $dates;
        $this->price = $price;
        $this->discount = $discount;
        $this->priceOption = $priceOption;
        $this->editUrl = $editUrl;
        $this->status = $status;
    }
}
