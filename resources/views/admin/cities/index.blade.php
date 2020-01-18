@extends('admin.layout.index')

@section('content')
    @include('admin.components.board.pass')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3 class="mb-0">Города</h3>
                            </div>
                            <div class="col-lg-4 text-right">
                                <a href="{{ route('admin.cities.create') }}" class="btn btn-sm btn-default">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Кол-во пользователей</th>
                                <th scope="col">Статус</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <a href="{{ route('admin.cities.show', $city->id) }}">
                                                    <span class="mb-0 text-sm">{{ $city->name }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        {{ $city->users()->count() }}
                                    </td>
                                    <td>
                                      <span class="badge badge-dot mr-4">
                                        <i class="{{ (int) $city->status?'bg-success':'bg-danger' }}"></i> {{ $city->getStatus() }}
                                      </span>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                    </td>
                                    <td class="text-right">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
