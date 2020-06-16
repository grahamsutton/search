<?php

namespace Search;

use Search\Context;
use Search\Contracts\Client;
use Search\Contracts\Results;
use Search\Contracts\Searchable;
use Search\Engine;
use Search\Query;

class Engine implements Searchable
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(Context $context): Results
    {
        return $this->client->search($context);
    }
}