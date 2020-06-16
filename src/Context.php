<?php

namespace Search;

abstract class Context
{
    protected $query;
    protected $identity;

    public function __construct(Query $query, Identity $identity)
    {
        $this->query    = $query;
        $this->identity = $identity;
    }

    public function getTypedInput(): string
    {
        return $this->query->getTypedInput();
    }

    public function getFilters(): array
    {
        return array_merge($this->query->getFilters(), $this->getContextFilters());
    }

    public function getItemsPerPage(): int
    {
        return $this->query->getItemsPerPage();
    }

    public function getPage(): int
    {
        return $this->query->getPage();
    }

    public function getSortDir(): string
    {
        return $this->query->getSortDir();
    }

    public function getSortFields(): array
    {
        return $this->query->getSortFields();
    }

    abstract public function getTextSearchFields(): array;
    abstract public function getFacets(): array;
    abstract public function getWeights(): array;
    abstract public function getContextFilters(): array;
}