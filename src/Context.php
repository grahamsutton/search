<?php

namespace Search;

class Context
{
    public function __construct()
    {
        $this->is_inclusive = false;
        $this->fields       = [];
        $this->connection   = [];
    }

    public function setConnection(array $connection)
    {
        $this->connection = $connection;

        return $this;
    }

    public function getConnection(): array
    {
        return $this->connection;
    }

    public function setIsInclusive(bool $is_inclusive): self
    {
        $this->is_inclusive = $is_inclusive;

        return $this;
    }

    public function isInclusive(): bool
    {
        return $this->is_inclusive;
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}