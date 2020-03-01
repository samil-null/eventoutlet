<?php


namespace App\Utils\Seo;

use SEOMeta;

class SEO
{
    public static $pages = [
        'home' => [
            'title' => 'Event Outlet - поиск свободных специалистов для вашего мероприятия со скидкой.'
        ],
        'lk.show' => [
            'title' => 'Личный кабинет'
        ],
        'lk.edit' => [
            'title' => 'Редактирование анкеты'
        ],
        'lk.offer.create' => [
            'title' => 'Добавить спецпредложение'
        ],
        'lk.offer.edit' => [
            'title' => 'Редактирование спецпредложения'
        ],
        'about' => [
            'title' => 'Как работает Event Outlet'
        ]
    ];

    public static function user($user)
    {
        SEOMeta::setTitle($user->name .' - '. $user->speciality->name);
    }

    public static function page($page)
    {
        SEOMeta::setTitle(self::$pages[$page]['title']);
    }

    public static function filter($speciality, $city)
    {
        SEOMeta::setTitle("Выбрать {$speciality} на определенную свободную в {$city} со скидкой.");
    }

}
