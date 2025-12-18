<?php

namespace App\Services;

use App\Events\OrderCreated;
use Ecotone\Modelling\Attribute\EventHandler;
use Ecotone\Modelling\Attribute\Distributed;
use Illuminate\Support\Facades\Log;

class LogisticsService
{
    #[Distributed]
    #[EventHandler]
    public function createShipment(OrderCreated $event)
    {
        $id = $event->orderId;
        Log::info("Creando envío para la orden: $id");
    }
}
