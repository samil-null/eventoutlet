@extends('site.layout.index')

@section('content')
    <profile
        create-offer-link="{{ route('site.lk.offers.create') }}"
    ></profile>
    
@endsection
@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush