@extends('site.layout.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <h1>{{ $user->name }}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4>{{ $user->speciality->name }}</h4>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <span>{{ $user->city->name }}</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12">
                        <p>{{ $user->about_me }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Предложения
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($user->offers as $offer)
                                    <li class="list-group-item" @if($offer->status == 1) style="background: green" @else style="background: red" @endif>
                                        {{ $offer->service->name }} |
                                        {{ $offer->discount_price }} {{ $offer->service->price_option }} |
                                        {{ $offer->discount }} %
                                        <br>
                                        @foreach($offer->dates as $date)
                                            <span>{{ $date->date }}</span><br>
                                        @endforeach
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Телефон</h6>
                                <span>{{ $user->info->phone }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Сайт</h6>
                                <span>{{ $user->info->site }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Instagram</h6>
                                <span>{{ $user->info->instagram }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Vk</h6>
                                <span>{{ $user->info->vk }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Стоимость</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($user->services as $service)
                                    <li class="list-group-item" @if($service->status == 1) style="background: green" @else style="background: red" @endif>
                                        {{ $service->name }} | {{ $service->price }} {{ $service->price_option }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
