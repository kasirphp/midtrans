<?php

declare(strict_types=1);

namespace Kasir\Midtrans;

use Psr\Http\Client\ClientExceptionInterface;

class PaymentService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     */
    public function cardToken(array $params): Response
    {
        $response = $this->client->request('get', $this->client->getUriForApi('/v2/token'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function charge(array $params): Response
    {
        $response = $this->client->request('post', $this->client->getUriForApi('/v2/charge'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function capture(array $params): Response
    {
        $response = $this->client->request('post', $this->client->getUriForApi('/v2/capture'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function approve(string $orderId, array $params = []): Response
    {
        $response = $this->client->request(
            'post',
            $this->client->getUriForApi('/v2/'.$orderId.'/approve'),
            [],
            $params
        );

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function deny(string $orderId, array $params = []): Response
    {
        $response = $this->client->request('post', $this->client->getUriForApi('/v2/'.$orderId.'/deny'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function cancel(string $orderId, array $params = []): Response
    {
        $response = $this->client->request('post', $this->client->getUriForApi('/v2/'.$orderId.'/cancel'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function expire(string $orderId, array $params = []): Response
    {
        $response = $this->client->request('post', $this->client->getUriForApi('/v2/'.$orderId.'/expire'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function refund(string $orderId, array $params = []): Response
    {
        $response = $this->client->request('post', $this->client->getUriForApi('/v2/'.$orderId.'/refund'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function directRefund(string $orderId, array $params = []): Response
    {
        $response = $this->client->request(
            'post',
            $this->client->getUriForApi('/v2/'.$orderId.'/refund/online/direct'),
            [],
            $params
        );

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function status(string $orderId, array $params = []): Response
    {
        $response = $this->client->request('get', $this->client->getUriForApi('/v2/'.$orderId.'/status'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function statusB2b(string $orderId, array $params = []): Response
    {
        $response = $this->client->request(
            'get',
            $this->client->getUriForApi('/v2/b2b/'.$orderId.'/status'),
            [],
            $params
        );

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function cardRegister(array $params): Response
    {
        $response = $this->client->request('get', $this->client->getUriForApi('/v2/card/register'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function pointInquiry(string $token, array $params = []): Response
    {
        $response = $this->client->request('get', $this->client->getUriForApi('/v2/point_inquiry/'.$token), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function gopayTokenization(array $params): Response
    {
        $response = $this->client->request('post', $this->client->getUriForApi('/v2/pay/account'), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function gopayAccount(string $token, array $params = []): Response
    {
        $response = $this->client->request('get', $this->client->getUriForApi('/v2/pay/account/'.$token), [], $params);

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function gopayUnbind(string $token, array $params = []): Response
    {
        $response = $this->client->request(
            'post',
            $this->client->getUriForApi('/v2/pay/account/'.$token.'/unbind'),
            [],
            $params
        );

        return new Response($response);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function bin(string $bin, array $params = []): Response
    {
        $response = $this->client->request('get', $this->client->getUriForApi('/v1/bins/'.$bin), [], $params);

        return new Response($response);
    }
}
