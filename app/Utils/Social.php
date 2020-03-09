<?php


namespace App\Utils;


class Social
{
    public function instagramUrl($tag)
    {
        return 'https://www.instagram.com/' . $tag;
    }

    public function instagramTag($tag)
    {
        return "@" . $tag;
    }

    public function whatsappUrl($whatsapp)
    {
        return 'https://wa.me/' . preg_replace("/[^0-9]/", '', $whatsapp);
    }
}
