@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You {{ Auth::user()->name }} are logged in!
                    <p>
                        {{ Auth::user()->role->name }}
                    </p>
                    <p>
                        {{ Auth::user()->name }}
                    </p>
                    <p>
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
