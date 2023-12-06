<?php

namespace Kasir\Midtrans;

use Psr\Http\Message\ResponseInterface;

class Response
{
    public ResponseInterface $response;

    public ?array $decoded = null;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getBody(): string
    {
        return $this->response->getBody()->getContents();
    }

    public function json(): array
    {
        $this->checkDecoded();

        return $this->decoded;
    }

    protected function checkDecoded(): void
    {
        if (is_null($this->decoded)) {
            $this->decoded = json_decode($this->getBody(), true);
        }
    }
}