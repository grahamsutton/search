<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Solr
    |--------------------------------------------------------------------------
    |
    | This value defines the configuration of each context used by Solr in the
    | main application.
    |
    */
    'solr' => [
        'connection' => [
            'endpoint' => [
                'localhost' => [
                    'host' => 'localhost',
                    'port' => '8983',
                    'path' => '/',
                    'core' => 'mycore'
                ]
            ]
        ],
        'contexts' => [
            'member.global_search' => [
                'inclusive' => false,
                'fields' => [
                    'compName_s',
                    'address_s'
                ]
            ]
        ]
    ]
];