<?php


namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Service;
use App\Models\User;
use App\Models\UserInfo;
use Cassandra\Type;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    protected function toValue($value) {
        return ($value == 'NULL')? null: $value;
    }

    protected $cities = array(
        array('id' => '17','name' => 'Барнаул'),
        array('id' => '21','name' => 'Брянск'),
        array('id' => '11','name' => 'Волгоград'),
        array('id' => '10','name' => 'Воронеж'),
        array('id' => '4','name' => 'Екатеринбург'),
        array('id' => '26','name' => 'Иркутск'),
        array('id' => '22','name' => 'Казань'),
        array('id' => '6','name' => 'Краснодар'),
        array('id' => '19','name' => 'Красноярск'),
        array('id' => '1','name' => 'Москва'),
        array('id' => '9','name' => 'Нижний Новгород'),
        array('id' => '3','name' => 'Новосибирск'),
        array('id' => '5','name' => 'Омск'),
        array('id' => '29','name' => 'Оренбург'),
        array('id' => '31','name' => 'Пенза'),
        array('id' => '24','name' => 'Пермь'),
        array('id' => '7','name' => 'Ростов-на-Дону'),
        array('id' => '30','name' => 'Рязань'),
        array('id' => '16','name' => 'Самара'),
        array('id' => '2','name' => 'Санкт-Петербург'),
        array('id' => '13','name' => 'Саратов'),
        array('id' => '23','name' => 'Ставрополь'),
        array('id' => '14','name' => 'Тольятти'),
        array('id' => '20','name' => 'Томск'),
        array('id' => '15','name' => 'Тула'),
        array('id' => '28','name' => 'Тюмень'),
        array('id' => '27','name' => 'Ульяновск'),
        array('id' => '12','name' => 'Уфа'),
        array('id' => '18','name' => 'Хабаровск'),
        array('id' => '8','name' => 'Челябинск'),
        array('id' => '25','name' => 'Ярославль')
    );

    protected $ct = [];

//    protected $cities = [
//        'Москва' => 1,
//        'Санкт-Петербург' => 2,
//        'Новосибирск'   => 3,
//        'Екатеринбург'  => 4,
//        'Омск'  => 5,
//        'Краснодар' => 6,
//        'Ростов-на-Дону' => 7,
//        'Челябинск' => 8,
//        'Нижний Новгород'   => 9,
//        'Воронеж'   => 10,
//        'Волгоград' => 11,
//        'Уфа'   => 12,
//        'Саратов'   => 13,
//        'Тольятти' => 14,
//        'Тула'  => 15,
//        'Самара'   => 16,
//        'Барнаул'   => 17,
//        ''
//    ];

    protected $specialty = [
        //'Невеста/Жена',
        'Фотограф' => 1,
        //'Гость на свадьбе',
        'Ведущий' => 2,
        'Видеограф' => 5,
        //'Жених/Муж',
        'Организатор' => 11,
        'Стилист' => 12,
        'Оформитель' => 10,
        'Автокомпания' => 18,
        'Музыкант' => 14,
        'Артист' => 20,
        'DJ' => 6,
        'Аксессуары' => 23,
        'Хореограф' => 21,
        'банкетный зал' => 16,
        'Букеты' => 10,
        //'Свадебные платья',
        //'Shop_dress',
        'Фотостудия' => 27,
        //'Теплоход',
        'Торты' => 13,
        'Кейтеринг' => 15,
        //'Другое',
        'Регистраторы' => 22,
        'Фотобудка' => 21,
        //'Обручальные кольца',
        'Фейерверк' => 21,
        //'Мужские костюмы'
    ];

    protected function clean($string) {
        return preg_replace('/[\x00-\x1F\x7F]/u', '', $string);
    }

    /**
     * @param string $city
     * @return string
     */
    public function getCityId(string $city)
    {
        return isset($this->ct[$city])? $this->ct[$city]: false;
    }

    /**
     * @param string $specialty
     * @return mixed
     */
    public function getSpecialtyId(string $specialty)
    {
        return isset($this->specialty[$specialty])? $this->specialty[$specialty]: null;
    }

    public function index()
    {

        foreach ($this->cities as $city) {
            $this->ct[$city['name']] = $city['id'];
        }

        //$this->services();
        //die;
//        echo mb_detect_encoding('HELLO');
//        die;

        $users = \DB::table('users_tmp')
                        ->whereNotNull('email')
                        ->whereNotNull('vk')
                        ->whereNotNull('description')
                        ->where('description', '!=', 'nfp')
                        ->where('city', '!=', 'Санкт-Петербург')
                        ->get();

//        dd($users);
//        die;

//        dd($users);
//        die;
        //$path = base_path() . '/app/Http/Controllers/data.csv';
        $count = 0;
//        $mapping = [];
//        $specials = [];

        //echo "<pre>";
//        //$client = \ATehnix\VkClient\Client();
//
        if (true) {
            foreach ($users as $user) {

                $user = (array) $user;

                if (empty($specials[$user['specialty']])) {
                    $specials[$user['specialty']] = 1;
                } else {
                    $specials[$user['specialty']] +=1;
                }



                if (is_numeric($this->getCityId($user['city'])) && is_numeric($this->getSpecialtyId($user['specialty']))) {
                    if (User::where('email', $user['email'])->orWhere('uid', 'grk-' . $user['user_id'])->exists()) continue;

                    $userType = ($user['type'] == 'Hum')?1:0;

                    $user['description'] = str_replace(['????', 'Показать ещё...'], ['', ''], $user['description']);

                    //$user['description'] = $this->clean($user['description']);

                    if ($user['instagram']) {
                        $user['instagram'] = trim(str_replace('https://www.instagram.com/', '', $user['instagram']), '/');
                    }

                    $media = [];

                    if ($user['media']) {
                        $media = json_decode($user['media']);
                    }

                    $gallery = [];

                    if (is_object($media)) {
                        $iter = 1;

                        foreach ($media->media as $image) {
                            if (!$image->original_url) continue;
                            if ($iter > 5) break;
                            $gallery[] = $this->createGallery($image);
                            $iter++;
                        }

                        dump($gallery);
                    }

                    $response = file_get_contents('https://api.gorko.ru/api/v2/users/' . $user['user_id']);
                    $userData = json_decode($response);
                    $filename = \Str::random(24) . '.jpg';
                    $filePath = storage_path('app/images/avatar/original/' . $filename);

                    try {
                        file_put_contents($filePath, file_get_contents($userData->user->avatar_url));
                        //$filename = $filename . '.jpg';
                    } catch (\Exception $e) {
                        $filename = null;
                    }

                    $createdUser = User::create([
                            'name'  => $user['name'],
                            'avatar' => $filename,
                            'email' => $user['email'],
                            'password'  => 'password1337',
                            'type'  => 1,
                            'uid'  => 'grk-' . $user['user_id']
                        ]);


                    $createdUser->attachRole('executor');

                    $createdUser->info()->create([
                        'email' => $user['email'],
                        'user_type' => $userType,
                        'phone' => $user['phone'],
                        'instagram' => $user['instagram'],
                        'vk'        => $user['vk'],
                        'about_me'  => $user['description'],
                        'site'  => $user['website'],
                        'speciality_id' => $this->getSpecialtyId($user['specialty']),
                        'city_id'   => $this->getCityId($user['city'])
                    ]);

                    foreach ($gallery as $item) {
                        $createdUser->gallery()->create($item);
                    }

//                    break;
//
//                    die;

//                            $instagram = trim($instagram, '/');
                }


                //continue;


                $count++;


                continue;

                if (isset($data[3]) && isset($data[4]) && isset($data[6]) && $data[6] != 'NULL' && count($data) == 16 && $data[12] != 'NULL') {

                    if ($data[3] == 'Санкт-Петербург' && $data[4] == 'Фотограф') {

//                        if (User::where('email', $data[6])->orWhere('uid', 'grk-' . $data[1])->exists()) continue;
//                        //$media = json_decode($data[11]);
//                        //dump($data);
//                        $instagram = null;
//
//                        if ($data[10] != 'NULL') {
//                            $instagram = str_replace('https://www.instagram.com/', '', $data[10]);
//
//                            $instagram = trim($instagram, '/');
//                        }

                        //continue;

                        $email = $data[6];
                        $userType = ($data[5] == 'Hum')?1:0;
//                        $response = file_get_contents('https://api.gorko.ru/api/v2/users/' . $data[1]);
//                        $userData = json_decode($response);
//                        $filename = \Str::random(24);
//                        $gallery = [];
//
                        $media = json_decode($data[11]);

                        if (is_object($media)) {
                            $iter = 1;

                            foreach ($media->media as $image) {
                                if ($iter > 5) break;
                                $gallery[] = $this->createGallery($image);
                                $iter++;
                            }

                            print_r($gallery);
                        }

                        //continue;

                        //dd(json_decode($data[11])->media);

                        //dd();
                        $filePath = storage_path('app/images/avatar/original/' . $filename . '.jpg');

//                        echo $filePath;
//                        die;
                        //dump(json_decode($data[11])->media);

                        //die;
                        //continue;
                        //dd(storage_path('app/images/avatar/original/' . \Str::random(24) . '.jpg'));
                        try {
                            file_put_contents($filePath, file_get_contents($userData->user->avatar_url));
                            $filename = $filename . '.jpg';
                        } catch (\Exception $e) {
                            $filename = null;
                        }


                        continue;
//                        $user = User::create([
//                            'name'  => $data[2],
//                            'avatar' => $filename,
//                            'email' => $email,
//                            'password'  => 'password1337',
//                            'type'  => 1,
//                            'uid'  => 'grk-' . $data[1]
//                        ]);
//
//                        $user->attachRole('executor');
//
//                        dump($data);
//
//                        $phone = ($data[7] == 'NULL')?null:$data[7];
//                        $vk = ($data[9] == 'NULL')?null:$data[9];
//                        $about_me = ($data[12] == 'NULL')?null:$data[12];
//                        $site = ($data[8] == 'NULL')?null:$data[8];
//
//                        $user->info()->create([
//                            'email' => $email,
//                            'user_type' => $userType,
//                            'phone' => $phone,
//                            'instagram' => $instagram,
//                            'vk'        => $vk,
//                            'about_me'  => $about_me,
//                            'site'  => $site,
//                            'speciality_id' => 1,
//                            'city_id'   => 2
//                        ]);
//
//                        foreach ($gallery as $item) {
//                            $user->gallery()->create($item);
//                        }


                        //die;
//                        $user->gallery()->create([
//
//                        ]);

                        $count++;
                    }
                }

            }
            //fclose($handle);
            //echo $count;
        }

        dump($specials);
    }

    public function createGallery($item)
    {
        $filename = \Str::random(24) . '.jpg';

        $filePath = storage_path('app/images/gallery/original/' . $filename);

        file_put_contents($filePath, file_get_contents($item->original_url));

        return [
            'name' => $filename,
            'type' => Media::GALLERY_TYPE,
            'source' => Media::STORE_SOURCE
        ];
    }

    public function list()
    {
        $users = User::where('type', 1)->paginate(10);

        return view('users-editor', compact('users'));
    }

    public function update(Request $request)
    {
        \DB::transaction(function () use ($request) {
            foreach ($request->post('description') as $id => $desc)
            UserInfo::where('user_id', $id)->update([
                'about_me' => $desc
            ]);
        });

        return back();
    }

    public function services()
    {
        echo "<h1>HELLO</h1>";

        $users = User::where('type', 1)->get();

        foreach ($users as $user) {
            $grkId = preg_replace('/[^0-9]/', '', $user->uid) . "<br>";

            $response = file_get_contents('https://api.gorko.ru/api/v2/users/' . $grkId . '?fields=catalog_prices');
            $userData = json_decode($response);

            //echo "dd: " . $user->services()->count() . "<br>";
            if ($user->services()->count() == 0) {

                foreach ($userData->user->catalog_prices as $price) {
                    $user->services()->create([
                        'status' => Service::ACTIVE_STATUS,
                        'price_option_id' => 4,
                        'name'  => $price->title,
                        'price' => $price->value1,
                        'description' => $price->description
                    ]);
                }

            }
           // dump($userData);
        }
    }
}