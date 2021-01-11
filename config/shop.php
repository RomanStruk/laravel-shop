<?php

use App\Services\Shipping\ShippingMethods\CourierMethod;
use App\Services\Shipping\ShippingMethods\NovaPoshtaMethod;

return [
    'currency_short' => '₴',
    'currency' => 'ГРН',

    'passport' => [
        'grant_type' => env('PASSPORT_GRANT_TYPE'),
        'client_id' => env('PASSPORT_CLIENT_ID'),
        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
    ],
];
