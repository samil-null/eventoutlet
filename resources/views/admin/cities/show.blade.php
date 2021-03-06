@extends('admin.layout.index')

@section('content')
    @include('admin.components.board.pass')

    @include('admin.components.alerts.delete', ['route' => route('admin.cities.destroy', $city->id)])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Город</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button href="#!" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-notification">Удалить</button>
                                <a href="#!" class="btn btn-sm btn-primary send-data-form">Сохранить</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.components.errors')
                        <form id="data-form" action="{{ route('admin.cities.update', $city->id) }}" method="post">
                            @csrf
                            {{ method_field('put') }}
                            <h6 class="heading-small text-muted mb-4">Информация</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-city-status">Статус</label>
                                            <select name="status" id="input-city-status" class="form-control form-control-alternative">
                                                @foreach($city->statuses as $value => $name)
                                                    <option value="{{ $value }}" @if($value == $city->status) selected @endif>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-username">Название</label>
                                            <input name="name" type="text" id="input-username" class="form-control form-control-alternative" placeholder="Название" value="{{ $city->name }}">
                                        </div>
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-seo_name">SEO Название</label>
                                            <input name="seo_name" type="text" id="input-seo_name" class="form-control form-control-alternative" placeholder="Название" value="{{ $city->seo_name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
