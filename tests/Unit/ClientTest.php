<?php

test('Client payment property returns PaymentAPI', function () {
    $client = \Kasir\Midtrans::client('something');

    expect($client->payment)
        ->toBeInstanceOf(\Kasir\PaymentApi::class);
});

test('Client subscription property returns SubscriptionAPI', function () {
    $client = \Kasir\Midtrans::client('something');

    expect($client->subscription)
        ->toBeInstanceOf(\Kasir\SubscriptionApi::class);
});
