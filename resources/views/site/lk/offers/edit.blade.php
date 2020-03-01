@extends('site.layout.index')

@section('content')
<edit-offer
    create-offer-link="{{ route('site.lk.offers.create') }}"
    offer-id="{{ $offer->id }}">
</edit-offer>
@endsection
