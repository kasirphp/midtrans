<?php

declare(strict_types=1);

use Kasir\Midtrans\BaseMidtransClient;
use Kasir\Midtrans\Response;
use Kasir\Midtrans\Services\PaymentService;
use Psr\Http\Message\ResponseInterface;

it('may send card tokenization request', function () {
    $client = setupClientMock('get', '/v2/token');

    $service = new PaymentService($client);
    $result = $service->cardToken([]);

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send charge request', function () {
    $client = setupClientMock('post', '/v2/charge');

    $service = new PaymentService($client);
    $result = $service->charge([]);

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send capture request', function () {
    $client = setupClientMock('post', '/v2/capture');

    $service = new PaymentService($client);
    $result = $service->capture([]);

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send approve request', function () {
    $client = setupClientMock('post', '/v2/order_id/approve');

    $service = new PaymentService($client);
    $result = $service->approve('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send deny request', function () {
    $client = setupClientMock('post', '/v2/order_id/deny');

    $service = new PaymentService($client);
    $result = $service->deny('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send cancel request', function () {
    $client = setupClientMock('post', '/v2/order_id/cancel');

    $service = new PaymentService($client);
    $result = $service->cancel('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send expire request', function () {
    $client = setupClientMock('post', '/v2/order_id/expire');

    $service = new PaymentService($client);
    $result = $service->expire('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send refund request', function () {
    $client = setupClientMock('post', '/v2/order_id/refund');

    $service = new PaymentService($client);
    $result = $service->refund('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send direct refund request', function () {
    $client = setupClientMock('post', '/v2/order_id/refund/online/direct');

    $service = new PaymentService($client);
    $result = $service->directRefund('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send status request', function () {
    $client = setupClientMock('get', '/v2/order_id/status');

    $service = new PaymentService($client);
    $result = $service->status('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send status b2b request', function () {
    $client = setupClientMock('get', '/v2/b2b/order_id/status');

    $service = new PaymentService($client);
    $result = $service->statusB2b('order_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send card register for one and two click request', function () {
    $client = setupClientMock('get', '/v2/card/register');

    $service = new PaymentService($client);
    $result = $service->cardRegister([]);

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send point balance of the card request', function () {
    $client = setupClientMock('get', '/v2/point_inquiry/token_id');

    $service = new PaymentService($client);
    $result = $service->pointInquiry('token_id');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send gopay tokenization request', function () {
    $client = setupClientMock('post', '/v2/pay/account');

    $service = new PaymentService($client);
    $result = $service->gopayTokenization([]);

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send gopay customer account detail request', function () {
    $client = setupClientMock('get', '/v2/pay/account/gopay_token');

    $service = new PaymentService($client);
    $result = $service->gopayAccount('gopay_token');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send unbind gopay account request', function () {
    $client = setupClientMock('post', '/v2/pay/account/gopay_token/unbind');

    $service = new PaymentService($client);
    $result = $service->gopayUnbind('gopay_token');

    expect($result)->toBeInstanceOf(Response::class);
});

it('may send bin metadata request', function () {
    $client = setupClientMock('get', '/v1/bins/bin_number');

    $service = new PaymentService($client);
    $result = $service->bin('bin_number');

    expect($result)->toBeInstanceOf(Response::class);
});

function setupClientMock(string $method, string $route, array $headers = [], array $body = []): BaseMidtransClient
{
    $client = Mockery::mock(BaseMidtransClient::class);
    $client->allows()->getUriForApi($route);

    $uri = $client->getUriForApi($route);

    $client->allows()
        ->request($method, $uri, $headers, $body)
        ->andReturn(Mockery::mock(ResponseInterface::class));

    return $client;
}
