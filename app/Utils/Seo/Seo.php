<?php


namespace App\Utils\Seo;

use SEOMeta;

class Seo
{
    public static function user($user)
    {
        SEOMeta::setTitle($user->name);
    }
}
