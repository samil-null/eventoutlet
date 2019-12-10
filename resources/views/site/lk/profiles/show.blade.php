@extends('site.layout.index')

@section('content')
    <profile
        create-offer-link="{{ route('site.lk.offers.create') }}"
        edit-profile-link="{{ route('site.lk.profiles.edit', Auth::user()->id) }}"
        user-id="{{ Auth::user()->id }}"
    ></profile>
@endsection
