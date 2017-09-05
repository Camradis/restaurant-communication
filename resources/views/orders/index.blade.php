@extends('layouts.main')

@section('page-header', 'Orders in action')

@section('panel-heading')
    Orders |
    @if (! Auth::user()->hasRole('kitchen'))
        <a href="{{ route('orders.create') }}">
            <button type="button" class="btn btn-primary btn-circle btn-lg">
                <i class="fa fa-plus"></i>
            </button>Add Order item
        </a>
    @endif
@endsection

@section('panel-body')
    <div class="row orders">
        @forelse( $orders as $order)
            <div class="col-lg-4 order-{{ $order->id }}">
                @include('layouts.partials.orders._order')
            </div>
        @empty
            <p>No orders found.</p>
        @endforelse
        <div class="col-lg-4">
            {{ $orders->render() }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
@endsection