@extends('admin.layout.index')

@section('content')

    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-10" role="document">
            <div class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">You should read this!</h4>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white">Ok, Got it</button>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
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
                                    <img width="200px" src="{{ ImgCrop::roc($user->avatar, 'avatar', 'avatar') }}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                            <a href="#" class="btn btn-sm btn-default float-right">Сообщение</a>
                        </div>
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
                            <a href="{{ route('site.users.show', $user->id) }}">Просмотреть страницу</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Аккаунт</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button href="#!" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-notification">Удалить</button>
                                <a href="#!" class="btn btn-sm btn-primary">Сохранить</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <h6 class="heading-small text-muted mb-4">Информация о пользователе</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-speciality">Специальность</label>
                                            <select class="form-control form-control-alternative" id="input-speciality">
                                                @foreach($specialties as $speciality)
                                                    <option value="{{ $speciality->id }}"
                                                    @if($user->specialty_id == $speciality->id) selected @endif
                                                    >{{ $speciality->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" value="{{ $user->email }}">
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
                                            <input type="text" id="input-phone" class="form-control form-control-alternative" placeholder="+7 (999) 123 45 67" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-site">Сайт</label>
                                            <input type="email" id="input-site" class="form-control form-control-alternative" placeholder="website.com" value="{{ $user->site }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">About me</h6>
                            <div class="pl-lg-4">
                                <div class="form-group focused">
                                    <label>About Me</label>
                                    <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Спецпредложения</h6>
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
                                              <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i> pending
                                              </span>
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
