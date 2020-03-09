<?php


namespace App\Utils\Seo;

use App\Helpers\AvatarHelper;
use Psy\Util\Json;
use SEOMeta;
use OpenGraph;
use JsonLd;

class SEO
{
    protected static $socials = [
        'vk', 'instagram'
    ];
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
        $title = $user->name .' - '. $user->speciality->name;
        $description = $user->info->about_me;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(route('site.users.show', $user->id));

        JsonLd::setType('WebPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::addImage(AvatarHelper::original($user->avatar));
        JsonLd::addValue('sameAs', self::createSocials($user->info));

    }

    public static function page($page)
    {
        SEOMeta::setTitle(self::$pages[$page]['title']);
    }

    public static function filter($speciality, $city)
    {
        SEOMeta::setTitle("Выбрать {$speciality} на определенную свободную в {$city} со скидкой.");
    }

    protected static function createSocials($info)
    {
        $socials = [];

        foreach ($info as $name => $link) {
            if (in_array($name, self::$socials)) {
                $socials[] = $link;
            }
        }

        return [];
    }

}
