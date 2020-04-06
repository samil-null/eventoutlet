@extends('site.layout.index')

@section('content')
<change-password token="{{ $token }}"></change-password>
@endsection
@push('scripts')
    <script src="{{ asset('js/pages/change.js') }}?global={{ env('JS_VERSION') }}&local=1"></script>
@endpush
