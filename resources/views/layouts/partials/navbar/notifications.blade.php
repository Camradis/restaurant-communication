<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-bell fa-fw"></i> Notifications
        <span class="badge">
                        {{ count(Auth::user()->unreadNotifications) }}
                    </span>
        <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-alerts">
        @forelse(Auth::user()->unreadNotifications as $notification)
            <div onclick="markNotificationAsRead({{ count(Auth::user()->unreadNotifications) }})">
                <li>
                    <i class="fa fa-envelope fa-fw"></i>
                    {{ $notification->data['user']['name'] }}
                        @if($notification->type == "App\\Notifications\\AddOrderToKitchen")
                            update
                        @else
                            add new
                        @endif
                    Order#{{ $notification->data['order']['id'] }}
                    <span class="pull-right text-muted small">{{ $notification->data['time']['date'] }}</span>
                </li>
            </div>
            <li class="divider"></li>
        @empty
            <div>
                <li>
                    Notifications not found
                </li>
            </div>
            <li class="divider"></li>
        @endforelse
    </ul>
    <!-- /.dropdown-alerts -->
</li>
<!-- /.dropdown -->