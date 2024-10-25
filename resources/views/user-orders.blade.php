<h1>Order History for {{ $user->name }}</h1>

@foreach($user->orders as $order)
    <h3>Order #{{ $order->order_number }}</h3>
    <ul>
        @foreach($order->products as $product)
            <li>{{ $product->name }} (Quantity: {{ $product->pivot->quantity }})</li>
        @endforeach
    </ul>
@endforeach
