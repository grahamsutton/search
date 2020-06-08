<?php

namespace Search\Engine;

use Search\Context;
use Search\Engine;
use Search\Results;
use Solarium\Client as SolariumClient;

class Solr extends Engine
{
    public function __construct(SolariumClient $client, Context $context)
    {
        $this->client         = $client;
        $this->context        = $context;
        $this->page           = 1;
        $this->items_per_page = 10;
    }

    public function search(): Results
    {
        $select = $this->client->createSelect();

        $query = $this->buildQuery();

        // /* GS */ echo __FILE__.': '.__LINE__.'<pre>';print_r($query);echo'</pre>';exit;

        $select
            ->setStart($this->getStart())
            ->setRows($this->items_per_page)
            ->setQuery($query);

        $response = $this->client->execute($select);

        $documents = array_map(
            function ($doc) {
                return $doc->getFields();
            }, 
            $response->getDocuments()
        );

        $results = (new Results($documents))
            ->setQuery($this->query)
            ->setPage($this->page)
            ->setItemsPerPage($this->items_per_page)
            ->setTotalFound($response->getNumFound());

        return $results;
    }

    private function getStart(): int
    {
        $start = ($this->page * $this->items_per_page) - $this->items_per_page - 1;

        return $start < 0 ? 0 : $start;
    }

    private function buildQuery()
    {
        $conditions = [];

        $fields   = $this->context->getFields();
        $operator = $this->context->isInclusive() ? 'OR' : 'AND';

        foreach ($fields as $index => $field) {
            $conditions[] = "{$field}:$this->query";
        }

        return implode(" {$operator} ", $conditions);
    }
}