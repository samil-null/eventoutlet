@extends('admin.layout.index')

@section('content')
    @include('admin.components.statistics')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Специальности</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Кол-во пользователей</th>
                                <th scope="col">Status</th>
                                <th scope="col">Users</th>
                                <th scope="col">Completion</th>
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
                                        <i class="bg-warning"></i> pending
                                      </span>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
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
