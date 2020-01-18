@extends('site.layout.index')

@section('content')
    <div class="container">
        <div class="row">
            <filter-app></filter-app>
        </div>
    </div>
    @foreach($users as $user)
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="{{ route('site.users.show', ['id' => $user->id]) }}" class="btn btn-primary">Переход куда-нибудь</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection
