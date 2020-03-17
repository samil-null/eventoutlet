@extends('site.layout.index')

@section('content')
<create-offer
    create-offer-link="{{ route('site.lk.offers.create') }}"
></create-offer>

@endsection
@push('scripts')
    <script src="{{ asset('js/pages/lk.js') }}"></script>
@endpush
