@extends('site.layout.index')

@section('content')
    <profile
        create-offer-link="{{ route('site.lk.offers.create') }}"
    ></profile>

@endsection
@push('scripts')
    <script src="{{ asset('js/pages/lk.js') }}"></script>
@endpush
