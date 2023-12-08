<?php

use Kasir\Midtrans\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

it('can retrieve body stream as array', function () {
    $body = [
        'status_code' => '200',
        'status_message' => 'Success, Credit Card transaction is successful',
        'transaction_id' => 'd0a6b7f3-3f5f-4b6a-8f8a-0f5b430a4c9a',
    ];
    $bodyString = json_encode($body);

    $streamInterface = Mockery::mock(StreamInterface::class);
    $streamInterface->allows()->getContents()
        ->andReturn($bodyString);

    $responseInterface = Mockery::mock(ResponseInterface::class);
    $responseInterface->allows()->getStatusCode()
        ->andReturn(200);
    $responseInterface->allows()->getBody()
        ->andReturn($streamInterface);

    $response = new Response($responseInterface);

    expect($response)
        ->toBeInstanceOf(Response::class)
        ->and($response->json())
        ->toBe($body)
        ->and($response->getStatusCode())
        ->toBe(200);
});
