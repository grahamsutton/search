<?php

namespace Search;

class Results
{
    public function __construct(array $documents = [])
    {
        $this->total_found = 0;
        $this->documents   = $documents;
    }

    public function setItemsPerPage(int $items_per_page): self
    {
        $this->items_per_page = $items_per_page;

        return $this;
    }

    public function getItemsPerPage(): int
    {
        return $this->items_per_page;
    }


    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setTotalFound(int $total_found): self
    {
        $this->total_found = $total_found;

        return $this;
    }

    public function getTotalFound(): int
    {
        return $this->total_found;
    }
}