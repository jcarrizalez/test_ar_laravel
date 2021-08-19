<?php
declare( strict_types = 1 );
namespace App\Services;

use App\Models\BookModel;
use App\Shared\EloquentPaginator;

/**
 * @group Domain BookIndex
 *
 * 
 */
class BookIndexService
{
    protected $model;
    protected $paginator;

    public function __construct(
        BookModel $model, 
        EloquentPaginator $paginator
    )
    {
        $this->model        = $model;
        $this->paginator    = $paginator;
    }

    /**
     * @param $page int |$count int|$search string
     *
     * @return array<object, true>
     */
    public function make(int $page, int $count, $search = null) :array
    {
        #se pagina el resultado
        return $this->paginator->paginate(
            $this->model->index($search),   #Builder $query
            $count,                         #$count = 10
            $page                           #$page = null
        );
    }
}