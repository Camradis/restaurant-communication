@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orders in action</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @if (! Auth::user()->hasRole('kitchen'))

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('orders.create') }}">
                <button type="button" class="btn btn-primary btn-circle btn-lg">
                    <i class="fa fa-plus"></i>
                </button>Add Order item
            </a>
            <hr>
        </div>
    </div>

    @endif

    <!-- /.row -->
    <div class="row orders">
        @forelse( $orders as $order)
        <div class="col-lg-4 order-{{ $order->id }}">
            <div class="panel panel-primary">
                <a href="{{ route('orders.show' , ['id' => $order->id]) }}">
                <div class="panel-heading">

                    Order # {{ $order->id }}

                </div>
                </a>
                <div class="panel-body">
                    @if (! Auth::user()->hasRole('server'))
                    <p>
                        <a href="{{ route('orders.completed.update' , $order) }}"
                           onclick="event.preventDefault();
                             document.getElementById('complete-form-{{ $order->id }}').submit();">
                            <i class="fa fa-circle fa-fw"></i>
                            @if ($order->status == 1)
                                Uncomplete
                            @else
                                Complete
                            @endif
                        </a>
                        <form id="complete-form-{{ $order->id }}" action="{{ route('orders.completed.update' , $order->id ) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                        </form>
                    </p>
                    @endif
                    <p> Dish: {{ $order->dish_name }}</p>
                    <p> Server:
                        @foreach($order->users as $user)
                            {{ $user->name }}
                        @endforeach
                    </p>
                </div>
                <div class="panel-footer">
                    Order status:
                    @if ($order->status == 1)
                        <i>Completed</i>
                    @else
                        <i>Uncompleted</i>
                    @endif

                    @if (! Auth::user()->hasRole('server'))
                    <a href="{{ route('orders.edit' , ['id' => $order->id ]) }}">Edit</a>
                        <p>
                            Board #<b>{{ $order->board }}</b>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        @empty
            <p>No orders found.</p>
        @endforelse
        <div class="col-lg-4">
            {{ $orders->render() }}
        </div>
    </div>
    <!-- /.row -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
@endsection