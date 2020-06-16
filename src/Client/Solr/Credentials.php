<?php

namespace Search\Client\Solr;

class Credentials
{
    public function __construct(string $host, int $port, string $path, string $core)
    {
        $this->host = $host;
        $this->port = $port;
        $this->path = trim($path, '/');
        $this->core = $core;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getCore(): string
    {
        return $this->core;
    }
}