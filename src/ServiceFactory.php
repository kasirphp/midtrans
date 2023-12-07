<?php

declare(strict_types=1);

namespace Kasir\Midtrans;

use Kasir\Midtrans\Services\PaymentService;

class ServiceFactory
{
    private array $services;

    public function __construct(private readonly BaseMidtransClient $client)
    {
        $this->services = [];
    }

    private static array $classMap = [
        'payment' => PaymentService::class
        // TODO: SubscriptionService
        // TODO: PayoutService
    ];

    public function __get($name)
    {
        return $this->getService($name);
    }

    protected function getServiceClass($name)
    {
        return array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }

    public function getService($name)
    {
        $serviceClass = $this->getServiceClass($name);

        if (null !== $serviceClass) {
            if (!array_key_exists($name, $this->services)) {
                $this->services[$name] = new $serviceClass($this->client);
            }

            return $this->services[$name];
        }

        trigger_error('Undefined property: '.static::class.'::$'.$name);

        return null;
    }
}
