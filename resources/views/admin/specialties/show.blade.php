@extends('admin.layout.index')

@section('content')
    @include('admin.components.board.pass')
    @include('admin.components.alerts.delete', ['route' => route('admin.specialties.destroy', $speciality->id)])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Специальность</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button href="#!" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-notification">Удалить</button>
                                <a href="#!" class="btn btn-sm btn-primary send-data-form">Сохранить</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" >
                        <form id="data-form" method="post" action="{{ route('admin.specialties.update', $speciality->id) }}">
                            @include('admin.components.errors')
                            @csrf
                            @method('put')
                            <h6 class="heading-small text-muted mb-4">Информация</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-city-status">Статус</label>
                                            <select name="status" id="input-city-status" class="form-control form-control-alternative">
                                                @foreach($speciality->statuses as $value => $name)
                                                    <option value="{{ $value }}" @if($value == $speciality->status) selected @endif>{{ $name }}</option>
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
                                            <input type="text" required name="name" id="input-username" class="form-control form-control-alternative" placeholder="Название" value="{{ $speciality->name }}">
                                        </div>
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-url">Url</label>
                                            <input type="text" required name="slug" id="input-url" class="form-control form-control-alternative" placeholder="Url" value="{{ $speciality->slug }}">
                                        </div>
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-seo-name">SEO Название</label>
                                            <input type="text" required name="seo_name" id="input-seo-name" class="form-control form-control-alternative" placeholder="Название" value="{{ $speciality->seo_name }}">
                                        </div>
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-plural-name">Название во множественном числе (Винительный падеж)</label>
                                            <input type="text" required name="plural_name" id="input-plural-name" class="form-control form-control-alternative" placeholder="Название" value="{{ $speciality->plural_name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="heading-small text-muted mb-4">Дополнительные свойства</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <additional-fields
                                            addition-fields="{{ json_encode($speciality->fields) }}"
                                            options="{{ json_encode($speciality->options) }}"
                                        ></additional-fields>
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
