<?php
namespace App\Events;

class OrderCreated
{
    public function __construct(
        public int $orderId,
        public string $customerEmail
    ) {}
}
