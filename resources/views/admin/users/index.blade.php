@extends('admin.layout.index')

@section('content')
    @include('admin.components.board.pass')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col-lg-8">
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
                                <th scope="col">Статус</th>
                            </tr>
                            </thead>
                            <tbody>

                                @if (count($users))
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder" src="{{ Imager::avatar($user->avatar) }}">
                                                </a>
                                                <div class="media-body">
                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="mb-0 text-sm">{{ $user->name }}</a>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                            <span class="badge custom-badge {{ (int) $user->verified?'badge-success':'badge-danger' }}">{{ $user->email }}</span>
                                        </td>
                                        <td>
                                              <span class="badge badge-dot mr-4">
                                                <i class="custom-status-{{ $user->status }}"></i> {{ $user->getStatus('name') }}
                                              </span>
                                        </td>
                                    </tr>
                                @endforeach
                                    @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{ $users->links('admin.components.pagination') }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <form class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <h3 class="mb-0">Фильтр</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-dark">Сбросить</a>
                                <button type="submit" class="btn btn-sm btn-primary">Применить</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-speciality">Специальность</label>
                            <select class="form-control form-control-alternative" id="input-speciality" name="speciality_id">
                                <option value="no">Нет</option>
                                @foreach(\App\Models\Specialty::all() as $speciality)
                                    <option value="{{ $speciality->id }}" @if($request->get('speciality_id') == $speciality->id) selected @endif>{{ $speciality->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-speciality">Город</label>
                            <select class="form-control form-control-alternative" id="input-speciality" name="city_id">
                                <option value="no">Нет</option>
                                @foreach(\App\Models\City::all() as $city)
                                    <option value="{{ $city->id }}" @if($request->get('city_id') == $city->id) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group focused">   
                            <label class="form-control-label" for="input-speciality">Статус</label>
                            <select class="form-control form-control-alternative" id="input-speciality" name="status">
                                <option value="no">Нет</option>
                                @foreach((new \App\Models\User())->statuses as $status => $name)
                                    <option value="{{ $status }}" @if(is_numeric($request->get('status')) && $request->get('status') == $status) selected @endif>{{ $name['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group focused">
                            <a  href="{{ route('admin.users.index', ['require_moderation' => 1]) }}" class="btn btn-secondary">Требуют модерации</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()
