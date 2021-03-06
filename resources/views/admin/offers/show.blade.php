@extends('admin.layout.index')

@section('content')
    @include('admin.components.board.pass')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 ">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Спец. предложение</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-secondary btn-sm" id="offer-message-block-btn">Сообщение</button>
                                <a href="#" class="btn btn-sm btn-primary send-data-form">Сохранить</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="data-form" action="{{ route('admin.offers.update', $offer->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div id="offer-message-block" style="display: none;">
                                <h6 class="heading-small text-muted mb-4">Сообщение пользователю</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group focused">
                                                <label>Сообщение</label>
                                                <textarea rows="8" name="message"  placeholder="Текст сообщения....." class="form-control form-control-alternative">
                                            </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mb-4">Предложение</h6>
                            <div class="pl-lg-4">
                                <div class="table-responsive card shadow mb-5 ">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Название</th>
                                            <th scope="col">Цена</th>
{{--                                            <th scope="col">Статус</th>--}}
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <a class="mb-0 text-sm" href="{{ route('admin.offers.show', $offer->id) }}">{{ $service->name }}</a>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ $service->price }}
                                            </td>
{{--                                            <td>--}}
{{--                                              <span class="badge badge-dot mr-4">--}}
{{--                                                <i class="custom-status-{{ $service->status }}"></i> {{ $offer->getStatus('name') }}--}}
{{--                                              </span>--}}
{{--                                            </td>--}}
                                            <td>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <h6 class="heading-small text-muted mb-4">Спец. предложение</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-offer-status">Статус</label>
                                                <select class="form-control form-control-alternative" id="input-offer-status" name="status">
                                                    @foreach($offer->statuses as $value => $name)
                                                        <option value="{{ $value }}"
                                                                @if($offer->status == $value) selected @endif
                                                        >{{ $name['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-offer-sale">Скидка</label>
                                            <input type="text" id="input-offer-sale"  disabled class="form-control form-control-alternative" placeholder="website.com" value="{{ $offer->discount }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group focused">
                                            <label>Условия</label>
                                            <textarea rows="8" name="description" class="form-control form-control-alternative" placeholder="">{{ $offer->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <form class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <h3 class="mb-0">Даты</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <calendar
                            raw-dates="{{ $offer->dates }}"
                        ></calendar>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

