<?php


namespace App\Factories\Algo;


interface AlgoFactoryInterface
{
    public function load($data, $isSpecials);
    public function create();
}
