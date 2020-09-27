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
                            <div class="col-lg-4 text-right">

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col"> Специальности</th>
                                <th scope="col">Даты</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Дата подписки</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{ $subscriber->email }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        @foreach($subscriber->specialities as $specialty)
                                            <div>{{ $specialty->speciality->name }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($subscriber->dates as $date)
                                                <li>{{ $date->date }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                      <span class="badge badge-dot mr-4">
                                        <i class="{{ (int) $subscriber->is_active?'bg-success':'bg-danger' }}"></i>
                                        {{ (int) $subscriber->is_active?'Активен':'Не активен' }}
                                      </span>
                                    </td>
                                    <td class="">
                                        {{ $subscriber->created_at->format('d-m-Y H:i:s') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer py-4">
                        {{ $subscribers->links('admin.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
