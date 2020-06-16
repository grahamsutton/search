<?php

namespace Search\Client\Solr;

use Search\Context;

class ContextParser
{
    public function parse(Context $context): string
    {
        $conditions = [];

        // Default to "search all" if no text search fields are specified
        if (empty($context->getTextSearchFields())) {
            $conditions['q'][] = '*:*';
        } else {
            foreach ($context->getTextSearchFields() as $field) {
                $conditions['q'][] = $field . ':' . $context->getTypedInput();
            }
        }

        // Build filters only if they have selected values
        foreach ($context->getFilters() as $field => $values) {
            if (count($values) > 0) {
                $conditions['fq'][] = $field . ':(' . implode(' ', $values) . ')';
            }
        }

        if (count($context->getFacets()) > 0) {
            $conditions['facet'] = 'on';

            foreach ($context->getFacets() as $field) {
                $conditions['facet.field'][] = $field;
            }
        }

        // Build sort fields if there are any
        foreach ($context->getSortFields() as $sort_field) {
            $conditions['sort'][] = $sort_field . ' ' . $context->getSortDir();
        }

        // Calculate pagination. "start" is the number of records to start after.
        $conditions['start'] = ($context->getPage() * $context->getItemsPerPage()) - $context->getItemsPerPage();
        $conditions['rows']  = $context->getItemsPerPage();

        // /* GS */ echo __FILE__.': '.__LINE__.'<pre>';print_r($conditions);echo'</pre>';exit;

        return $this->build($conditions);
    }

    private function build(array $conditions): string
    {
        $tokens = [];

        foreach ($conditions as $param => $condition) {
            $query = "{$param}=";

            $query .= is_array($condition)
                ? implode(' AND ', $condition)
                : $condition;

            $tokens[] = $query;
        }

        return implode('&', $tokens);
    }
}