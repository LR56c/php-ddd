<?php
return [
    'serviceName' => 'tienda_service',
    'namespaces' => [
        'App',
    ],
    'defaultSerializationMediaType' => 'application/json',
    'loadAppNamespaces' => true,
    'defaultConnection' => 'rabbitmq',
    'connections' => [
        'rabbitmq' => [
            'driver' => 'amqp',
        ],
    ],
];
