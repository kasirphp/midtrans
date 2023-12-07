<?php

use Kasir\Midtrans\MidtransClient;
use Kasir\Midtrans\Services\PaymentService;

it('can create a client', function () {
    $client = new MidtransClient('key');

    expect($client)->toBeInstanceOf(MidtransClient::class);
});


it('can get the corresponding service', function () {
    $services = [
        'payment' => PaymentService::class,
    ];

    $client = new MidtransClient();

    foreach ($services as $name => $class) {
        expect($client->$name)->toBeInstanceOf($class);
    }
});
