@extends('admin.layout.index')

@section('content')
    @include('admin.components.board.pass')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3 class="mb-0">Подписчики</h3>
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
                                @foreach($specialties as $speciality)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <a href="{{ route('admin.specialties.show', $speciality->id) }}">
                                                        <span class="mb-0 text-sm">{{ $speciality->name }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            {{ $speciality->users()->count() }}
                                        </td>
                                    <td>
                                      <span class="badge badge-dot mr-4">
                                        <i class="{{ (int) $speciality->status?'bg-success':'bg-danger' }}"></i> {{ $speciality->getStatus() }}
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
