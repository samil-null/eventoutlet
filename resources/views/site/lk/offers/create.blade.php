@extends('site.layout.index')

@section('content')
<create-offer 
create-offer-link="{{ route('site.lk.offers.create') }}"
edit-profile-link="{{ route('site.lk.profiles.edit', Auth::user()->id) }}"
></create-offer>
@endsection
