@extends('shops.layout.master')

@section('content')
<div class="row match-height">
    @success
    @include('shops.dashboard.sections.recent')
</div>
@endsection