<?php


namespace App\Helpers;


class SocialHelper
{
    public static function instagramConvertToTag(?string $string)
    {
        if (strpos($string, 'instagram.com') !== false) {
            $params = explode('/', $string);
            return end($params);

        } elseif (strpos($string, '@') === 0) {
            return substr($string,1);
        }

        return null;
    }
}
