<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use Ecotone\Modelling\EventBus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, EventBus $eventBus)
    {
        $newOrderId = 1050;
        $eventBus->publish(new OrderCreated(
            $newOrderId,
            'cliente@ejemplo.com',
        ));
        return response()->json(['message' => 'Orden recibida y procesando']);
    }
}
