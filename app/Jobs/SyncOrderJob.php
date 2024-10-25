<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\OrderSyncService;
use Exception;

class SyncOrderJob extends Job
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(OrderSyncService $orderSyncService)
    {
        try {
            $orderSyncService->syncOrder($this->order);
        } catch (Exception $e) {
            \Log::error('Order Sync Failed: ' . $e->getMessage());
        }
    }
}
