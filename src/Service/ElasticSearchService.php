<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Contracts\SearchEngineInterface;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticSearchService implements SearchEngineInterface
{
    private string $elasticHost;
    private Client $client;

    public function __construct(string $elasticHost)
    {
        $this->elasticHost = $elasticHost;
        $this->client = ClientBuilder::create()->setHosts([$this->elasticHost])->build();
    }

    public function index(array $params)
    {
        return $this->client->index($params);
    }

    public function delete(array $params)
    {
        return $this->client->delete($params);
    }

    public function get(array $params): array
    {
        return $this->client->get($params);
    }

    public function search(array $params)
    {
        return $this->client->search($params);
    }
}