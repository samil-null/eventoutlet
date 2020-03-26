<?php


namespace App\Helpers;


class SocialHelper
{
    public static function instagramConvertToTag($string)
    {
        $trimString = trim(trim($string), '/');

        if (strpos($trimString, 'instagram.com') !== false) {
            $params = explode('/', $trimString);

            return end($params);

        } elseif (strpos($trimString, '@') === 0) {
            return substr($string,1);
        }

        return $string;
    }

    public static function pureSiteName($url)
    {
        $trimUrl = trim(trim($url), '/');

        return str_replace(['http://', 'https://', 'www.'], ['', '', ''], $trimUrl);
    }
}
