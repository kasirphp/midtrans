<?php

declare(strict_types=1);

namespace Kasir\Midtrans;

use Http\Discovery\Psr17Factory;
use Http\Discovery\Psr18ClientDiscovery;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface as PsrClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BaseMidtransClient
{
    /**
     * The default API base URL.
     */
    public const DEFAULT_API_BASE = 'https://api.midtrans.com';

    /**
     * The default sandbox API base URL.
     */
    public const DEFAULT_SANDBOX_API_BASE = 'https://api.sandbox.midtrans.com';

    /**
     * The default app base URL.
     */
    public const DEFAULT_APP_BASE = 'https://app.midtrans.com';

    /**
     * The default sandbox app base URL.
     */
    public const DEFAULT_SANDBOX_APP_BASE = 'https://app.sandbox.midtrans.com';

    /**
     * The default config.
     */
    public const DEFAULT_CONFIG = [
        'key' => null,
        'api_base' => self::DEFAULT_API_BASE,
        'app_base' => self::DEFAULT_APP_BASE,
    ];

    /**
     * The default sandbox config.
     */
    public const SANDBOX_CONFIG = [
        'key' => null,
        'api_base' => self::DEFAULT_SANDBOX_API_BASE,
        'app_base' => self::DEFAULT_SANDBOX_APP_BASE,
    ];

    /**
     * HTTP client instance.
     */
    private PsrClientInterface $httpClient;

    /**
     * Configuration options.
     */
    private array $config;

    public function __construct(array|string $config = [], PsrClientInterface $httpClient = null, bool $sandbox = false)
    {
        if (is_string($config)) {
            $config = ['key' => $config];
        }

        if (is_null($httpClient)) {
            $this->httpClient = Psr18ClientDiscovery::find();
        } else {
            $this->httpClient = $httpClient;
        }

        $defaultConfig = $sandbox ? self::SANDBOX_CONFIG : self::DEFAULT_CONFIG;

        $config = array_merge($defaultConfig, $config);
        $this->validateConfig($config);

        $this->config = $config;
    }

    public function getConfig($key = null): array|string
    {
        if ($key) {
            return $this->config[$key];
        }

        return $this->config;
    }

    public function getHttpClient(): PsrClientInterface
    {
        return $this->httpClient;
    }

    public function getUriForApi(string $route): string
    {
        if (!str_starts_with($route, '/')) {
            $route = '/'.$route;
        }

        return $this->getConfig('api_base').$route;
    }

    protected function validateConfig(array $config): void
    {
        if (null !== $config['key'] && !is_string($config['key'])) {
            throw new InvalidArgumentException('key must be null or a string');
        }

        if ('' === $config['key']) {
            $msg = 'key cannot be the empty string';

            throw new InvalidArgumentException($msg);
        }

        if (null !== $config['key'] && (preg_match('/\s/', $config['key']))) {
            $msg = 'key cannot contain whitespace';

            throw new InvalidArgumentException($msg);
        }

        if (!is_string($config['api_base'])) {
            throw new InvalidArgumentException('api_base must be a string');
        }

        if (!is_string($config['app_base'])) {
            throw new InvalidArgumentException('app_base must be a string');
        }

        $extraConfigKeys = array_diff(array_keys($config), array_keys(self::DEFAULT_CONFIG));
        if (!empty($extraConfigKeys)) {
            // Wrap in single quote to more easily catch trailing spaces errors
            $invalidKeys = "'".implode("', '", $extraConfigKeys)."'";

            throw new InvalidArgumentException('Found unknown key(s) in configuration array: '.$invalidKeys);
        }
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function request($method, $absUrl, $headers, $params): ResponseInterface
    {
        $request = $this->constructRequest($method, $absUrl, $headers, $params);

        return $this->getHttpClient()->sendRequest($request);
    }

    private function constructRequest($method, $absUrl, $headers, $params): RequestInterface
    {
        $factory = new Psr17Factory();

        $request = $factory->createRequest($method, $absUrl);

        $headers = $this->constructRequestHeaders($headers);

        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request->withBody($factory->createStream(json_encode($params)));
    }

    private function constructRequestHeaders(array $headers): array // TODO: Use HeaderFactory
    {
        $headers['Authorization'] = 'Basic '.base64_encode($this->config['key'].':');
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';

        return $headers;
    }
}
