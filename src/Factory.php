<?php

namespace Search;

use GuzzleHttp\Client as HttpClient;
use Search\Client\Solr as SolrClient;
use Search\Client\Solr\Credentials as SolrCredentials;
use Search\Client\Solr\ContextParser as SolrContextParser;
use Search\Identity;

class Factory
{
    public static function makeClient(string $client_name)
    {
        switch ($client_name) {
            case 'solr':
                return new SolrClient(
                    new HttpClient(),
                    new SolrCredentials('localhost', 8983, '/solr/', 'mycore'),
                    new SolrContextParser()
                );
        }
    }

    public static function makeIdentity(string $data_source)
    {
        switch ($data_source) {
            case 'session':
                return new Identity(
                    'CN_eff_c_id', 
                    'members', 
                    'AC_member', 
                    ['AC_master1', 'AC_master2']
                );
        }
    }
}