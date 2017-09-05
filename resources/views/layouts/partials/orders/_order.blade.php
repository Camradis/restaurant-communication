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
        Order status: {{ $order->status }}

        @if (! Auth::user()->hasRole('server'))
            <a href="{{ route('orders.edit' , ['id' => $order->id ]) }}">Edit</a>
            <p>
                Board #<b>{{ $order->board }}</b>
            </p>
        @endif
    </div>
</div>