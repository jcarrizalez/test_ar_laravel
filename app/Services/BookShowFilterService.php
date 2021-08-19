<?php
declare( strict_types = 1 );
namespace App\Services;

use App\Models\BookModel;
use App\Shared\EloquentPaginator;

/**
 * @group Domain BookShowFilter
 *
 * 
 */
class BookShowFilterService
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
     * @param $slug string|$page int |$count int|$search string
     *
     * @return array<object, true>
     */
    public function make(string $slug, int $page, int $count, $search = null) :array
    {
        #se pagina el resultado
        return $this->paginator->paginate(
            $this->model->showFilter($slug, $search),   #Builder $query
            $count,                                     #$count = 10
            $page                                       #$page = null
        );
    }
}