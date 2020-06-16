<?php

namespace Search\Contracts;

use Search\Contracts\Results;
use Search\Context;

interface Searchable
{
    public function search(Context $context): Results;
}
