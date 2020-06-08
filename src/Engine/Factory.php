<?php

namespace Search\Engine;

use Search\Context;
use Search\Engine;
use Search\Engine\Solr as Solr;
use Solarium\Client as SolariumClient;
use Solarium\Core\Client\Adapter\Curl as SolariumCurl;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Factory
{
    public function __construct()
    {
        $this->config = require_once __DIR__ . '/../../config/search.php';
    }

    public function makeEngine(string $engine_name, string $context_name): Engine
    {
        $config = $this->config[$engine_name]['contexts'][$context_name];

        $context = (new Context())
            ->setConnection($this->config[$engine_name]['connection'] ?? [])
            ->setFields($config['fields'] ?? [])
            ->setIsInclusive($config['is_inclusive'] ?? true);

        switch ($engine_name) {
            case 'solr':
                return $this->createSolrEngine($context);
        }
    }

    private function createSolrEngine(Context $context): Solr
    {
        $client = new SolariumClient(
            new SolariumCurl(), 
            new EventDispatcher(), 
            $context->getConnection()
        );

        return new Solr($client, $context);
    }
}