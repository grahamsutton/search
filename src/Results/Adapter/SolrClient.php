<?php

namespace Search\Results\Adapter;

use Search\Contracts\Results;

class SolrClient implements Results
{
    private $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getNumFound(): int
    {
        return (int) $this->response['response']['numFound'] ?? 0;
    }

    public function getDocuments(): array
    {
        return $this->response['response']['docs'] ?? [];
    }
}