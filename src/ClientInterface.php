<?php

declare(strict_types=1);

namespace Kasir\Midtrans;

interface ClientInterface
{
    public function request($method, $absUrl, $headers, $params);
}
