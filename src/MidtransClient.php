<?php

declare(strict_types=1);

namespace Kasir\Midtrans;

/**
 * @property PaymentService $payment
 */
class MidtransClient extends BaseMidtransClient implements ClientInterface
{
    private ?ServiceFactory $serviceFactory = null;

    public function __get(string $name)
    {
        return $this->getService($name);
    }

    public function getService($name)
    {
        if (null === $this->serviceFactory) {
            $this->serviceFactory = new ServiceFactory($this);
        }

        return $this->serviceFactory->getService($name);
    }
}
