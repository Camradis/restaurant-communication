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

    <div class="form-group{{ $errors->has('board') ? ' has-error' : '' }}">
        <label for="board" class="col-md-4 control-label">Board Number</label>

        <div class="col-md-6">
            <input id="board" type="text" class="form-control" name="board" value="{{ old('board') }}" required>

            @if ($errors->has('board'))
                <span class="help-block">
                                        <strong>{{ $errors->first('board') }}</strong>
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