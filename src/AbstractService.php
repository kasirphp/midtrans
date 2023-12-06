<?php

declare(strict_types=1);

namespace Kasir\Midtrans;

abstract class AbstractService
{
    public function __construct(
        protected readonly BaseMidtransClient $client
    ) {
    }
}
