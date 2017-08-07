@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create order</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('orders.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('dish_name') ? ' has-error' : '' }}">
                            <label for="dish_name" class="col-md-4 control-label">Dish Name</label>

                            <div class="col-md-6">
                                <input id="dish_name" type="text" class="form-control" name="dish_name" value="{{ old('dish_name') }}" required autofocus>

                                @if ($errors->has('dish_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dish_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->

@endsection