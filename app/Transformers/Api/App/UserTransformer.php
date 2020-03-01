<?php


namespace App\Transformers\Api\App;


namespace App\Transformers\Api\App;

use App\Helpers\AvatarHelper;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function __construct()
    {
        AvatarHelper::init();
    }

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => $user->status,
            'avatar' => [
                'small' => AvatarHelper::small($user->avatar),
                'middle' => AvatarHelper::middle($user->avatar),
                'original' => AvatarHelper::original($user->avatar)
            ],
            'info' => [
                'email' => $user->info->email,
                'site' => $user->info->site,
                'instagram' => $user->info->instagram,
                'vk' => $user->info->vk,
                'whatsapp' => $user->info->whatsapp,
                'about_me' => $user->info->about_me,
                'phone' => $user->info->phone,
                'speciality_id' => $user->info->speciality_id,
                'city_id' => $user->info->city_id,
                'gender' => $user->info->gender,
                'speciality' => $user->info->speciality->name
            ]
        ];
    }
}
