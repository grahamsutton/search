<?php

namespace Search;

use Search\Engine;

interface PaginatedEngine extends Engine
{
    public function page(int $page): self;
    public function itemsPerPage(int $items_per_page): self;
}