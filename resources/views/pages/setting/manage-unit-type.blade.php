@extends('layouts.app', ['activePage' => 'unitType', 'titlePage' => __('Manage Unit Type')])

@section('content')
<div class="content pt-0" id="app">
    <unit-type></unit-type>
</div>
<script src="{{ asset('js/app.js') }}"></script>

@endsection
