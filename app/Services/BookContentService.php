<?php
declare( strict_types = 1 );
namespace App\Services;

use App\Models\BookModel;
use App\Shared\EloquentPaginator;
use App\Shared\Cache;

/**
 * @group Domain BookShowFilter
 *
 * 
 */
class BookContentService
{
    protected $model;
    protected $cache;
    protected $paginator;

    public function __construct(
        BookModel $model, 
        Cache $cache,
        EloquentPaginator $paginator
    )
    {
        $this->model        = $model;
        $this->cache        = $cache;
        $this->paginator    = $paginator;
    }

    /**
     * @param $slug string|$page int |$count int|$search string
     *
     * @return array<object, true>
     */
    public function make(string $slug, int $page, int $count, $search = null) :array
    {   
        $cache = $slug.$page.$count.$search;

        #si existe en Cache se hace el return
        if(null !== $response = $this->cache->get($cache)){

            return $response;
        }

        #se pagina el resultado
        $response = $this->paginator->paginate(
            $this->model->content($slug, $search),   #Builder $query
            $count,                                     #$count = 10
            $page                                       #$page = null
        );

        #dejo en cache
        $this->cache->put($cache, $response);

        return $response;
    }
}