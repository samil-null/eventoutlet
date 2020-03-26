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
                                <h3 class="mb-0">Услуга</h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-secondary btn-sm" id="offer-message-block-btn">Сообщение</button>
                                <a href="#" class="btn btn-sm btn-primary send-data-form">Сохранить</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="data-form" action="{{ route('admin.services.update', $service->id) }}" method="post">
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
                                            <th scope="col">Добавлено</th>
                                            <th scope="col">Обновлено</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{{ $service->name }}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ \Carbon\Carbon::parse($service->created_at)->format('d.m.Y H:i:s') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($service->updated_at)->format('d.m.Y H:i:s') }}
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

                            <h6 class="heading-small text-muted mb-4">Информация</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-offer-status">Статус</label>
                                                <select class="form-control form-control-alternative" id="input-offer-status" name="status">
                                                    @foreach($service->statuses as $value => $name)
                                                        <option value="{{ $value }}"
                                                                @if($service->status == $value) selected @endif
                                                        >{{ $name['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-offer-sale">Цена</label>
                                            <input type="text" id="input-offer-sale"  disabled class="form-control form-control-alternative" value="{{ $service->price }}">
                                        </div>
                                    </div>

                                    @foreach($service->fields as $field)
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-offer-sale">{{ $field->metaField->name }}</label>
                                                <input type="text" id="input-offer-sale"  disabled class="form-control form-control-alternative" value="{{ $field->value }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group focused">
                                            <label>Условия</label>
                                            <textarea rows="8" disabled class="form-control form-control-alternative" placeholder="A few words about you ...">{{ $service->description }}</textarea>
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

