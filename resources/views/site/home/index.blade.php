@extends('site.layout.index')

@section('content')
    <div class="container">
        <h1>home page</h1>
        <search
            :specialities="{{ $specialities }}"
        ></search>
    </div>
@endsection
