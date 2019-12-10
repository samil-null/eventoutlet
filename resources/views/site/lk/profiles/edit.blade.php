@extends('site.layout.index')

@section('content')
    <edit-profile
        user-id="{{ Auth::user()->id }}"
    ></edit-profile>
@endsection

