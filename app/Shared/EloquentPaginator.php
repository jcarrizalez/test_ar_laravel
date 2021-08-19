<?php 
declare( strict_types = 1 );
namespace App\Shared;

use Illuminate\Database\Eloquent\Builder;

class EloquentPaginator
{
	
	public static function paginate(Builder $query, $count=10, $page=null) :array
	{
      $paginate =  $query->paginate((int) $count, ['*'], 'page', $page);

      return [
      	'elements' => $query->get(),
      	'metadata' =>[
			'count' => $count,
			'page' => $paginate->currentPage(),
			'total' => $paginate->total(),
			'total_pages' => $paginate->lastPage(),
        ]
       ];
	}
}