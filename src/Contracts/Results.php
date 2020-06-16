<?php

namespace Search\Contracts;

interface Results
{
    public function getDocuments(): array;
    public function getNumFound(): int;
}