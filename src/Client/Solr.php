<?php

namespace Search\Client;

use GuzzleHttp\Client as HttpClient;
use Search\Client\Solr\ContextParser;
use Search\Client\Solr\Credentials;
use Search\Context;
use Search\Contracts\Client;
use Search\Contracts\Results;
use Search\Results\Adapter\SolrClient as SolrClientResultsAdapter;

class Solr implements Client
{
    private $http_client;
    private $credentials;
    private $parser;

    public function __construct(HttpClient $http_client, Credentials $credentials, ContextParser $parser)
    {
        $this->http_client = $http_client;
        $this->credentials = $credentials;
        $this->parser      = $parser;
    }

    private function baseUrl(): string
    {
        $host = $this->credentials->getHost();
        $port = $this->credentials->getPort();
        $path = $this->credentials->getPath();
        $core = $this->credentials->getCore();

        return "{$host}:{$port}/{$path}/{$core}";
    }

    public function search(Context $context): Results
    {
        $query_string = $this->parser->parse($context);

        $response = $this->http_client->request('GET', $this->baseUrl() . '/select?' . $query_string);

        $contents = json_decode($response->getBody()->getContents(), true);

        return new SolrClientResultsAdapter($contents);
    }
}