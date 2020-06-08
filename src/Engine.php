<?php

namespace Search;

use Search\Results;

abstract class Engine
{
    public function itemsPerPage(int $items_per_page): self
    {
        $this->items_per_page = $items_per_page;

        return $this;
    }

    public function page(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function query(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    abstract public function search(): Results;
}