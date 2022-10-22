<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Eloquent\Relations\Relation;

abstract class SearchableController extends Controller
{
    abstract function getQuery() : Builder;
    
    function filterByTerm(Builder|Relation $query, ?string $term) : Builder|Relation 
    {
        if(!empty($term)) {
            foreach(\preg_split('/\s+/', \trim($term)) as $word) {
            $query->where(function(Builder $innerQuery) use ($word) {
            $innerQuery
            ->where('code', 'LIKE', "%{$word}%")
            ->orWhere('name', 'LIKE', "%{$word}%");
            } );
    }
    }
    return $query;
    }
    
    function prepareSearch(array $search) : array 
    {
        $search['term'] = $search['term'] ?? null;
        return $search;
    }


    function filterBySearch(Builder|Relation $query, array $search) : Builder|Relation 
    {
        return $this->filterByTerm($query, $search['term']);
    }
    function search(array $search) : Builder|Relation 
    {
        $query = $this->getQuery();
        return $this->filterBySearch($query, $search);
    }

    function find(string $code) 
    {
        return $this->getQuery()->where('code', $code)->firstOrFail();
    }
}