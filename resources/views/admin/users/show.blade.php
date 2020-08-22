@extends('admin.layout.index')

@section('content')
    @include('admin.components.alerts.delete', ['route' => route('admin.users.destroy', $user->id)])
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-size: cover; background-position: center;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1 class="display-2 text-white">{{ $user->name }}</h1>
                    <p class="text-white mt-0 mb-5">{{ $user->about_me }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img width="200px" src="{{ Imager::avatar($user->avatar, 'middle') }}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">{{ $user->info->views }}</span>
                                        <span class="description">Просмотров</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $user->gallery()->count() }}</span>
                                        <span class="description">Фото</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ $user->name }}
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $user->city->name }}
                            </div>
                            <hr class="my-4">
                            @if ($user->slug)
                                <a href="{{ route('site.users.show', $user->slug) }}">Просмотреть страницу</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">Аккаунт</h3>
                                    <div class="admin-email-verify-status">
                                        @if($user->verified)
                                            <span class="badge badge-success">Верифицирован</span>
                                        @else
                                            <span class="badge badge-danger">Не верифицирован</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <button href="#!" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-notification">Удалить</button>
                                <a href="#!" class="btn btn-sm btn-primary send-data-form">Сохранить</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="data-form" method="post" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('put')
                            <h6 class="heading-small text-muted mb-4">Информация о пользователе</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-user-status">Статус</label>
                                            <select class="form-control form-control-alternative" id="input-user-status" name="status">
                                                @foreach($user->statuses as $value => $name)
                                                    <option value="{{ $value }}"
                                                            @if($user->status == $value) selected @endif
                                                    >{{ $name['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-user-status">Роль</label>
                                            <div class="multiple-select__container">
                                                <select name="roles[]" class="form-control form-control-alternative multiple-select__select" id="input-user-status" multiple>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                                @if($user->hasRole($role->name)) selected @endif
                                                        >{{ $role->display_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-username">Имя</label>
                                            <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email</label>
                                            <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="john@example.com" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-speciality-status">Специальность</label>
                                            <select class="form-control form-control-alternative" id="input-speciality-status">
                                                @foreach($specialties as $speciality)
                                                    <option @if($user->speciality->id == $speciality->id ) selected @endif> {{ $speciality->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city-status">Город</label>
                                            <select class="form-control form-control-alternative" id="input-city-status">
                                                @foreach($cities as $city)
                                                    <option @if($user->city->id == $city->id ) selected @endif> {{ $city->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Контакты</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-phone">Телефон</label>
                                            <input type="text" id="input-phone" class="form-control form-control-alternative" placeholder="+7 (999) 123 45 67" value="{{ $user->info->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-user-email">Email</label>
                                            <input type="email" id="input-user-email" class="form-control form-control-alternative" placeholder="john@example.com" value="{{ $user->info->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-user-site">Сайт</label>
                                            <input type="text" id="input-user-site" class="form-control form-control-alternative" placeholder="website.com" value="{{ $user->info->site }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-user-insta">Instagram</label>
                                            <input type="email" id="input-user-insta" class="form-control form-control-alternative" placeholder="@example" value="{{ $user->info->instagram }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-user-vk">Вконтакте</label>
                                            <input type="text" id="input-user-vk" class="form-control form-control-alternative" placeholder="website.com" value="{{ $user->info->vk }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-user-whatsapp">Whatsapp</label>
                                            <input type="email" id="input-user-whatsapp" class="form-control form-control-alternative" placeholder="+7 999 111 22 33" value="{{ $user->info->whatsapp }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Галерея</h6>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="admin-gallery">
                                            @foreach($user->gallery as $image)
                                                <a href="{{ ImgCrop::getFileUrl($image->name, 'gallery') }}" class="card admin-gallery__item image-gallery" style="background-image: url({{ ImgCrop::getFileUrl($image->name, 'gallery') }})">

                                                </a>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Видео</h6>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="admin-gallery admin-gallery_video">
                                            @foreach($user->videos as $video)
                                                <a href="{{ App\Helpers\VideoPathHelper::url($video->name, $video->source) }}" data-video="{{ App\Helpers\VideoPathHelper::url($video->name, $video->source) }}" class="card admin-gallery__item video-gallery" style="background-image: url({{ App\Helpers\VideoPathHelper::thumbUrl($video->name, $video->source) }})">

                                                </a>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">Обо мне</h6>
                            <div class="pl-lg-4">
                                <div class="form-group focused">
                                    <label>Обо мне</label>
                                    <textarea rows="8" name="about_me" class="form-control form-control-alternative" placeholder="">{{ $user->info->about_me }}</textarea>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4">
                        <form action="{{ route('admin.services.change_status') }}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <h6 class="heading-small text-muted mb-4 d-flex justify-content-between">
                                Услуги <button class="btn btn-sm btn-primary">Сохранить</button>
                            </h6>
                            @foreach($user->services as $service)
                            <!-- Modal -->
                                <div class="modal fade" id="service-comment-{{ $service->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Комментарий к "{{ $service->name }}"</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea class="form-control" name="comments[{{ $service->id }}]" rows="6" placeholder="Комментарий к услуге"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="table-responsive card shadow mb-5">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Название</th>
                                        <th scope="col">Цена</th>
                                        <th scope="col">Статус</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->services as $service)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <a class="mb-0 text-sm" href="{{ route('admin.services.edit', $service->id) }}">{{ $service->name }}</a>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ $service->price }}
                                            </td>
                                            <td>
                                                <select class="form-control form-control-alternative" name="services_status[{{ $service->id }}]">
                                                    @foreach($service->statuses as $value => $name)
                                                        <option value="{{ $value }}"
                                                                @if($service->status == $value) selected @endif
                                                        >{{ $name['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#service-comment-{{ $service->id }}" class="btn btn-secondary btn-sm">Добавить комментарий</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <form action="{{ route('admin.offers.change_status') }}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4 d-flex justify-content-between">
                                Спецпредложения<button class="btn btn-sm btn-primary">Сохранить</button>
                            </h6>
                            <div class="table-responsive card shadow mb-5">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Название</th>
                                        <th scope="col">Цена / со скидкой</th>
                                        <th scope="col">Скидка</th>
                                        <th scope="col">Статус</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->offers as $offer)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <a class="mb-0 text-sm" href="{{ route('admin.offers.show', $offer->id) }}">{{ $offer->service->name }}</a>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ $offer->service->price }} / {{ $offer->discount_price }}
                                            </td>
                                            <td>
                                                {{ $offer->discount }} %
                                            </td>
                                            <td>
                                                <select class="form-control form-control-alternative"  name="offers_status[{{ $offer->id }}]">
                                                    @foreach($offer->statuses as $value => $name)
                                                        <option value="{{ $value }}"
                                                                @if($offer->status == $value) selected @endif
                                                        >{{ $name['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
