<?php

namespace App\Search;

use Elasticsearch\Client;

class ElasticsearchObserver {

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function saved ($model) {
        $this->client->index([
           'index' => $model->getSearchIndex(),
           'type' => $model->getSearchType(),
           'id' => $model->id,
           'body' => $model->toSearchArray()
        ]);
    }

    public function delete ($model) {
        $this->client->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->id,
        ]);
    }
}
