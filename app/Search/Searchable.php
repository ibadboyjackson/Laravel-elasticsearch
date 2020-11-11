<?php

namespace App\Search;

trait Searchable {

    /**
     * This makes it easy to toggle the search feature flag
     * on and off. This is going to prove useful later on
     * when deploy the new search engine to a live app.
     */
    public static function bootSearchable () {

        if (config('service.search.enable')) {
            static::observe(ElasticsearchObserver::class);
        }
    }

    public function getSearchIndex () {
        return $this->getTable();
    }

    public function getSearchType () {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType();
        }
        return $this->getTable();
    }

    /**
     * By having a custom method that transforms the model
     * to a searchable array allows us to customize the
     * data that's going to be searchable per model.
     * @return mixed
     */
    public function toSearchArray () {
        return $this->toArray();
    }
}
