@extends('site.layout.index')

@section('content')
<edit-offer
    create-offer-link="{{ route('site.lk.offers.create') }}"
    edit-profile-link="{{ route('site.lk.profiles.edit', Auth::user()->id) }}" 
    offer-id="{{ $offer->id }}">
</edit-offer>
@endsection
