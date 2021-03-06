
@extends('admin.layout.index')

@section('content')
    @include('admin.components.board.pass')

    @include('admin.components.alerts.delete', ['route' => route('admin.roles.destroy', $role->id)])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
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
                        <form id="data-form" action="{{ route('admin.roles.update', $role->id) }}" method="post">
                            @csrf
                            {{ method_field('put') }}
                            <h6 class="heading-small text-muted mb-4">Информация</h6>
                            @if(false)
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
                            @endif
                            <div class="pl-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-username">Название для программы</label>
                                            <input name="name" type="text" id="input-username" class="form-control form-control-alternative" placeholder="Название" value="{{ $role->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-display-name">Отображаемое название</label>
                                            <input name="display_name" type="text" id="input-display-name" class="form-control form-control-alternative" placeholder="Название" value="{{ $role->display_name }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group focused">
                                            <label>Описание</label>
                                            <textarea rows="8" name="description" placeholder="Описание роли" class="form-control form-control-alternative">{{ $role->description }}</textarea>
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
