@extends('admin.layout.index')

@section('content')
    @include('admin.components.statistics')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Пользователи</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Имя</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Status</th>
                                <th scope="col">Users</th>
                                <th scope="col">Completion</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder" src="{{ ImgCrop::roc($user->avatar,'avatar', 'avatar')?? '/assets/avatars/'.random_int(1,6).'.png'}}">
                                                </a>
                                                <div class="media-body">
                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="mb-0 text-sm">{{ $user->name }}</a>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                              <span class="badge badge-dot mr-4">
                                <i class="bg-warning"></i> pending
                              </span>
                                        </td>
                                        <td>
                                            <span>pass</span>
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
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
