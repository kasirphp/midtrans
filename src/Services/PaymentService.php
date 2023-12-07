<?php

declare(strict_types=1);

namespace Kasir\Midtrans\Services;

use Kasir\Midtrans\Response;
use Psr\Http\Client\ClientExceptionInterface;

class PaymentService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     */
    public function cardToken(array $params): Response
    {
        $uri = $this->client->getUriForApi('/v2/token');
        $response = $this->client->request('get', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function charge(array $params): Response
    {
        $uri = $this->client->getUriForApi('/v2/charge');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function capture(array $params): Response
    {
        $uri = $this->client->getUriForApi('/v2/capture');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function approve(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/'.$orderId.'/approve');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function deny(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/'.$orderId.'/deny');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function cancel(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/'.$orderId.'/cancel');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function expire(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/'.$orderId.'/expire');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function refund(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/'.$orderId.'/refund');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function directRefund(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/'.$orderId.'/refund/online/direct');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function status(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/'.$orderId.'/status');
        $response = $this->client->request('get', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function statusB2b(string $orderId, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/b2b/'.$orderId.'/status');
        $response = $this->client->request('get', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function cardRegister(array $params): Response
    {
        $uri = $this->client->getUriForApi('/v2/card/register');
        $response = $this->client->request('get', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function pointInquiry(string $token, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/point_inquiry/'.$token);
        $response = $this->client->request('get', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function gopayTokenization(array $params): Response
    {
        $uri = $this->client->getUriForApi('/v2/pay/account');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function gopayAccount(string $token, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/pay/account/'.$token);
        $response = $this->client->request('get', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function gopayUnbind(string $token, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v2/pay/account/'.$token.'/unbind');
        $response = $this->client->request('post', $uri, [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function bin(string $bin, array $params = []): Response
    {
        $uri = $this->client->getUriForApi('/v1/bins/'.$bin);
        $response = $this->client->request('get', $uri, [], $params);

        return new Response($response);
    }
}
