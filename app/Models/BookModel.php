<?php
declare( strict_types = 1 );
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use DB;

class BookModel extends Model
{
 	protected $table      = 'books';
    protected $contents   = 'book_contents';

    protected $fillable = [
	];

    protected $hidden = [
    	'id', 
        'created_at', 
    	'updated_at',
    ];


    public function scopeIndex($query, $search = null) :Builder
    {
        $query->select('slug', 'name');

        if($search !== null){
            $query
                ->where('id', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%");
        }
        return $query;
    }


    public function scopeShow($query, string $slug, int $page) :Builder
    {
        return $query
            ->select("{$this->table}.folder","{$this->contents}.image")
            ->where("{$this->table}.slug", $slug)
            ->join($this->contents, function($join) use ($page){
                $join->on("{$this->contents}.book_id", "{$this->table}.id");
                $join->on("{$this->contents}.page", DB::raw($page));
            });
    }


    public function scopeShowFilter($query, string $slug, $search = null) :Builder
    {
        $query
            ->select("{$this->contents}.page", "{$this->contents}.text_content")
            ->where("{$this->table}.slug", $slug)
            ->join($this->contents, "{$this->contents}.book_id", "{$this->table}.id");

        if($search !== null){
            $query->where("{$this->contents}.text_content", 'LIKE', "%{$search}%");
        }
        return $query->orderBy("{$this->contents}.page"); 
    }
}