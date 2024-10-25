<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;

class OrderSyncService
{
    public function syncOrder(Order $order)
    {
        $response = Http::post('https://api.example.com/orders', [
            'order_number' => $order->order_number,
            'user' => $order->user->name,
            'products' => $order->products->map(function ($product) {
                return [
                    'name' => $product->name,
                    'quantity' => $product->pivot->quantity,
                ];
            }),
        ]);

        if ($response->successful()) {
            return true;
        }

        throw new \Exception('Order sync failed: ' . $response->body());
    }
}
