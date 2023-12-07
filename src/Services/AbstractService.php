<?php

declare(strict_types=1);

namespace Kasir\Midtrans\Services;

use Kasir\Midtrans\BaseMidtransClient;

abstract class AbstractService
{
    public function __construct(
        protected readonly BaseMidtransClient $client
    ) {
    }
}
