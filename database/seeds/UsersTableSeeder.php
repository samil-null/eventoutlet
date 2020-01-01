<?php

//use Str;
use App\Models\User;
use App\Models\Offer;
use App\Models\UserInfo;
use App\Models\OfferDate;
use App\Models\Service;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $denis = User::create([
            'email' => 'denis.budancev@gmail.com',
            'name' => 'Denis Budancev',
            'password' => bcrypt('qwerty')
        ]);

        $denis->attachRole('executor');

        factory(UserInfo::class)->create([
            'user_id' => $denis->id
        ]);

        factory(User::class, 10)->create()->each(function ($user) {
            factory(UserInfo::class)->create([
                'user_id' => $user->id
            ]);

            $user->attachRole('executor');

            factory(Service::class, random_int(1, 3))->create([
                'user_id' => $user->id
            ])->each(function ($service) {
                factory(Offer::class, random_int(1,3))->create([
                    'service_id' => $service->id
                ])->each(function ($offer) {
                    factory(OfferDate::class, random_int(1,2))->create([
                        'offer_id' => $offer->id
                    ]);
                });
            });
        });

    }
}
