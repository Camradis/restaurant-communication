@extends('layouts.main')

@extends('layouts.main')

@section('page-header', 'Users in action')

@section('panel-heading', 'Administrate Users')

@section('panel-body')
    @include('layouts.partials.admin._searching')
    @include('layouts.partials.admin._table')
@endsection