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
            'id'            => (int) $user->id,
            'name'          => (string) $user->name,
            'email'         => (string) $user->email,
            'status'        => (int) $user->status,
            'status_name'   => (string) $user->getStatus('public_name'),
            'avatar' => [
                'small'     => (string) AvatarHelper::small($user->avatar),
                'middle'    => (string) AvatarHelper::middle($user->avatar),
                'original'  => (string) AvatarHelper::original($user->avatar)
            ],
            'info' => [
                'email'         => (string) $user->info->email,
                'user_type'     => (int) $user->info->user_type,
                'site'          => (string) $user->info->site,
                'instagram'     => (string) $user->info->instagram,
                'vk'            => (string) $user->info->vk,
                'whatsapp'      => (string) $user->info->whatsapp,
                'about_me'      => (string) $user->info->about_me,
                'phone'         => (string) $user->info->phone,
                'speciality_id' => (int) $user->info->speciality_id,
                'city_id'       => (int) $user->info->city_id,
                'gender'        => (int) $user->info->gender,
                'speciality'    => (string) $user->info->speciality->name
            ]
        ];
    }
}
