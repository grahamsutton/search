<?php

namespace Search\Context;

use Search\Context;
use Search\Query;
use Search\Identity;

class Manufacturers extends Context
{
    public function getContextFilters(): array
    {
        return [
            // 'owner_account_id' => $this->identity->getNetworkIds()
        ];
    }

    public function getTextSearchFields(): array
    {
        return [];
    }

    public function getFacets(): array
    {
        return ['role_name'];
    }

    public function getWeights(): array
    {
        return ['compName_s', 'address_s'];
    }
}