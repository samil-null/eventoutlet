@extends('site.layout.index')

@section('content')
<edit-offer
    create-offer-link="{{ route('site.lk.offers.create') }}"
    offer-id="{{ $offer->id }}">
</edit-offer>
@push('scripts')
    <script src="{{ asset('js/pages/lk.js') }}"></script>
@endpush
@endsection
