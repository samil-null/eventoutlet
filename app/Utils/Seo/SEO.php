<?php


namespace App\Utils\Seo;

use App\Models\City;
use App\Models\Specialty;
use App\Models\UserInfo;
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
                'route' => 'site.lk.profile.show',
                'params' => ''
            ]
        ],
        'lk.edit' => [
            'title' => 'Редактирование анкеты',
            'description' => 'Редактирование анкеты',
            'url' => [
                'route' => 'site.lk.profile.edit',
                'params' => ''
            ]
        ],
        'lk.offer.create' => [
            'title' => 'Добавить спецпредложение',
            'description' => 'Добавить спецпредложение',
            'url' => [
                'route' => 'site.lk.offers.create',
                'params' => ''
            ]
        ],
        'lk.offer.edit' => [
            'title' => 'Редактирование спецпредложения',
            'description' => 'Редактирование спецпредложения',
            'url' => [
                'route' => 'site.lk.offers.edit',
                'params' => [0]
            ]
        ],
        'about' => [
            'title' => 'Как работает Event Outlet',
            'description' => 'Event Outlet – информационный портал по поиску исполнителей на мероприятия.',
            'url' => [
                'route' => 'site.about',
                'params' => ''
            ]
        ],
        'forgot' => [
            'title' => 'Восстановление пароля',
            'description' => 'Страница восстановление пароля',
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

        $sameAs = [];

        if ($user->info->vk) {
            $sameAs[] = Social::webSiteUrl($user->info->vk);
        }

        if ($user->info->site) {
            $sameAs[] = Social::webSiteUrl($user->info->site);
        }

        if ($user->info->instagram) {
            $sameAs[] = Social::instagramUrl($user->info->instagram);
        }

        JsonLd::addValue('name', $user->name);
        JsonLd::addValue('url', route('site.users.show', $user->slug));

        JsonLd::addValue('location', [
            'type' => 'Place',
            'address' => [
                'type' => 'PostalAddress',
                'addressLocality' => $user->city->name,
                'addressRegion' => 'Россия'
            ]
        ]);

        if ($user->info->user_type == UserInfo::PERSONAL) {
            self::personal($user, $title, $description);
        } elseif($user->info->user_type == UserInfo::ORGANIZATION) {
            self::organization($user);
        }

        JsonLd::addValue('sameAs', $sameAs);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(route('site.users.show', $user->slug));

    }

    protected static function personal($user, $title, $description)
    {
        JsonLd::setType('Person');
        JsonLd::addValue('image', AvatarHelper::original($user->avatar));
        if ($user->info->email) {
            JsonLd::addValue('email', $user->info->email);
        }

        if ($user->info->phone) {
            JsonLd::addValue('telephone', $user->info->phone);
        }
        JsonLd::addValue('jobTitle', $user->speciality->name);


    }

    protected static function organization($user)
    {
        JsonLd::setType('Organization');

        JsonLd::addValue('logo', AvatarHelper::original($user->avatar));
        $contactPoint = [
            'contactType' => 'Sales',
            'areaServed' => 'RU',
            'availableLanguage' => 'Russian'
        ];

        if ($user->info->email) {
            $contactPoint['email'] = $user->info->email;
        }

        if ($user->info->phone) {
            $contactPoint['telephone'] = $user->info->phone;
        }

        JsonLd::addValue('contactPoint', $contactPoint);

        
    }

    public static function page($page)
    {
        $title = self::$pages[$page]['title'];
        $description = self::$pages[$page]['description'];
        $route = self::$pages[$page]['url']['route'];
        $params = self::$pages[$page]['url']['params'];
        

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        JsonLd::setType('WebPage');
        JsonLd::setDescription($description);
        JsonLd::setTitle($title);
        JsonLd::setUrl(route($route, $params));
        JsonLd::addValue('image', '/assets/og-logo.jpg');
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
        JsonLd::addValue('image', '/assets/og-logo.jpg');
        JsonLd::setDescription($description);
    }

    public static function createSpecialitiesList()
    {
        return Specialty::all('plural_name')->map(function ($item) {
            return mb_strtolower($item->plural_name);
        })->implode(',');
    }
}
