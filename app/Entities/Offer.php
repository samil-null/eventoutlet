<?php


namespace App\Entities;


class Offer
{
    public $id;

    public $serviceName;

    public $description;

    public $dates;

    public $price;

    public $discount;

    public $priceOption;

    public $editUrl;

    public $status;

    public function __construct($id, $serviceName, $description, $dates, $price, $discount, $priceOption, $editUrl, $status)
    {
        $this->id = $id;
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
