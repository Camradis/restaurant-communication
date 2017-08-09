Hi, Kitchen

Order# {{ $order->id }} is created.
Dish name: {{ $order->dish_name }}

Best regards, {{ $order->users->first()->name }}