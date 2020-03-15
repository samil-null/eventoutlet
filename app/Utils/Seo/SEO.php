<?php


namespace App\Utils\Seo;

use App\Models\City;
use App\Models\Specialty;
use SEOMeta;
use OpenGraph;
use JsonLd;
use App\Helpers\AvatarHelper;
use App\Helpers\SocialHelper;
use Social;

class SEO
{
    protected static $socials = [
        'vk', 'instagram'
    ];

    public static $pages = [
        'home' => [
            'title' => 'Event Outlet - поиск свободных специалистов для вашего мероприятия со скидкой.',
            'description' => 'Event Outlet – информационный портал по поиску исполнителей на мероприятия.',
            'url' => [
                'route' => 'site.home',
                'params' => ''
            ]
        ],
        'lk.show' => [
            'title' => 'Личный кабинет',
            'description' => 'Личный кабинет',
            'url' => [
                'route' => 'site.lk',
                'params' => ''
            ]
        ],
        'lk.edit' => [
            'title' => 'Редактирование анкеты',
            'description' => 'Редактирование анкеты',
            'url' => [
                'route' => 'site.lk',
                'params' => ''
            ]
        ],
        'lk.offer.create' => [
            'title' => 'Добавить спецпредложение',
            'description' => 'Добавить спецпредложение',
            'url' => [
                'route' => 'site.lk',
                'params' => ''
            ]
        ],
        'lk.offer.edit' => [
            'title' => 'Редактирование спецпредложения',
            'description' => 'Редактирование спецпредложения',
            'url' => [
                'route' => 'site.lk',
                'params' => ''
            ]
        ],
        'about' => [
            'title' => 'Как работает Event Outlet',
            'description' => 'Event Outlet – информационный портал по поиску исполнителей на мероприятия.',
            'url' => [
                'route' => 'site.about',
                'params' => ''
            ]
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
        OpenGraph::setUrl(route('site.users.show', $user->slug));

        JsonLd::setType('WebPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::addImage(AvatarHelper::original($user->avatar));
        //self::createSocials($user->info)
        $sameAs = [];

        if ($user->info->vk) {
            $sameAs[] = Social::webSiteUrl($user->info->vk);
        }

        if ($user->info->site) {
            $sameAs[] = Social::webSiteUrl($user->info->site);
        }
        JsonLd::addValue('sameAs', $sameAs);

    }

    public static function page($page)
    {
        $title = self::$pages[$page]['title'];
        $description = self::$pages[$page]['description'];
        $route = self::$pages[$page]['url']['route'];

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        JsonLd::setType('WebPage');
        JsonLd::setDescription($description);
        JsonLd::setTitle($title);
        JsonLd::setUrl(route($route));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);

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

    public static function offers($city, $speciality, $specials)
    {
        $title = '';
        $description = '';
        $specialities = self::createSpecialitiesList();
        $specialityName = $speciality? mb_strtolower($speciality->seo_name):null;
        $cityName = $city? $city->seo_name:null;
        $description = "Выбор специалистов из каталога: {$specialities}. Закажите услугу профессионала в ближайший 31 день со скидкой от 10% до 70%.";
        if (is_null($city) && is_null($speciality) ) {
            $title = 'Поиск свободных специалистов для вашего мероприятия';

        }

        if (is_null($city) && !is_null($speciality)) {
            $title = "Поиск {$specialityName} для вашего мероприятия";
        }

        if (!is_null($city) && is_null($speciality)) {
            $title = "Поиск специалистов в {$cityName} для вашего мероприятия";
        }

        if (!is_null($city) && !is_null($speciality)) {
            $title = "Поиск {$specialityName} в {$cityName} для вашего мероприятия";
        }

        $title = $specials? $title . ' со скидкой': $title;
        $title = $title . ' - Event Outlet.';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);

        JsonLd::setType('WebPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
    }

    public static function createSpecialitiesList()
    {
        return Specialty::all('plural_name')->map(function ($item) {
            return mb_strtolower($item->plural_name);
        })->implode(',');
    }
}
