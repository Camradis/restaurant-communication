Hi, {{ $order->users()->first()->name }}

Order# {{ $order->id }} is updated.
Dish name: {{ $order->dish_name }}

Best regards, Kitchen