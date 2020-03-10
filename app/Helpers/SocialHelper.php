<?php


namespace App\Helpers;


class SocialHelper
{
    public static function instagramConvertToTag($string)
    {
        if (strpos(trim($string, '/'), 'instagram.com') !== false) {
            $params = explode('/', $string);
            return end($params);

        } elseif (strpos($string, '@') === 0) {
            return substr($string,1);
        }

        return null;
    }
}
