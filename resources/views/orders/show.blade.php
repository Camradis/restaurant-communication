@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orders in action</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Order # {{ $order->id }}
                </div>
                <div class="panel-body">
                    <p> Dish: {{ $order->dish_name }}</p>
                </div>
                <div class="panel-footer">
                    Order status: {{ $order ->status }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

@endsection