@extends('layouts.main')

@section('page-header', 'Orders in action')

@section('panel-heading')
    Order # {{ $order->id }}
@endsection

@section('panel-body')
    <div class="row">
        <div class="col-lg-4">
            @include('layouts.partials.orders._order')
        </div>
    </div>
@endsection