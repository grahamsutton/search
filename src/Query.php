<?php

namespace Search;

class Query
{
    const PARAM_FILTER         = 'f_';
    const PARAM_ITEMS_PER_PAGE = 'per';
    const PARAM_PAGE           = 'p';
    const PARAM_TYPED_INPUT    = 'q';
    const PARAM_SORT_FIELDS    = 's';
    const PARAM_SORT_DIR       = 'sd';

    private $filters = [];
    private $items_per_page;
    private $page;
    private $typed_input;
    private $sort_dir;
    private $sort_fields;

    public function __construct(string $url)
    {
        $this->parse($url);
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getItemsPerPage(): int
    {
        return $this->items_per_page;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getSortDir(): string
    {
        return $this->sort_dir;
    }

    public function getSortFields(): array
    {
        return $this->sort_fields;
    }

    public function getTypedInput(): string
    {
        return $this->typed_input;
    }

    private function isFilter(string $field): bool
    {
        return substr($field, 0, 2) == 'f_';
    }

    private function parse(string $url): void
    {
        $parts = parse_url($url);

        parse_str($parts['query'] ?? '', $params);

        $sort_fields = $params[self::PARAM_SORT_FIELDS] ?? null;

        $this->typed_input    = $params[self::PARAM_TYPED_INPUT] ?? '';
        $this->items_per_page = $params[self::PARAM_ITEMS_PER_PAGE] ?? 15;
        $this->page           = $params[self::PARAM_PAGE] ?? 1;
        $this->sort_fields    = !empty($sort_fields) ? explode(',', $sort_fields) : [];
        $this->sort_dir       = $params[self::PARAM_SORT_DIR] ?? 'DESC';

        foreach ($params as $field => $value) {
            if ($this->isFilter($field)) {
                $name   = str_replace(self::PARAM_FILTER, '', $field);
                $values = !empty($value) ? explode(',', $value) : [];

                $this->filters[$name] = $values;
            }
        }
    }
}