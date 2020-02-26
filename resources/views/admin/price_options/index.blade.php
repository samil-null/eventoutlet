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
                                <h3 class="mb-0">Специальности</h3>
                            </div>
                            <div class="col-lg-4 text-right">
                                <a href="{{ route('admin.priceOptions.create') }}" class="btn btn-sm btn-default">Добавить</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($options as $option)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <a href="{{ route('admin.priceOptions.show', $option->id) }}">
                                                        <span class="mb-0 text-sm">{{ $option->name }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <td>

                                        </td>
                                    <td>

                                    </td>
                                        <td></td>
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
