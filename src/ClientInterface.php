<?php

namespace Kasir\Midtrans;

interface ClientInterface
{
    public function request($method, $absUrl, $headers, $params);
}
