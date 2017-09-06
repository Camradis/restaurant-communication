@extends('layouts.main')

@section('page-header', 'Orders in action')

@section('panel-heading', 'Create order')

@section('panel-body')
    @include('layouts.partials.orders._form')
@endsection
