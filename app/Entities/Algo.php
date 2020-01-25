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

    public function __construct($id = '', $name = '', $avatar = '', $speciality = '', $offer = '', $info ='', $gallery = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->avatar = $avatar;
        $this->speciality = $speciality;
        $this->offer = $offer;
        $this->info = $info;
        $this->gallery = $gallery;
    }
}

