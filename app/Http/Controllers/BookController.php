<?php
declare( strict_types = 1 );
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\BookIndexService;
use App\Services\BookShowService;
use App\Services\BookShowFilterService;
use Exception;

/**
 * @group Application Book
 *
 * 
 */
class BookController extends Controller
{
    protected $show;
    protected $index;
    protected $show_filter;
    protected $page;
    protected $count;
    protected $search;

    public function __construct(
        Request $request, 
        BookShowService $show,
        BookIndexService $index,
        BookShowFilterService $show_filter
    )
    {
        $this->index        = $index;
        $this->show         = $show;
        $this->show_filter  = $show_filter;
        $this->page         = (int) $request->get('page', 1);
        $this->count        = (int) $request->get('count', 10);
        $this->search       = $request->get('search', null);
    }

    /**
     * @bodyParam page string not_required default '1'
     * @bodyParam count string not_required default '1'
     * @bodyParam search string not_required default null
     */
    public function index() :object
    {
        return jsend_success(
            $this->index->make(
                $this->page,    #int page
                $this->count,   #int count
                $this->search   #search = null
            )
        );
    }

    /**
     * @bodyParam slug string required nombre del libro.
     * @bodyParam page string not_required default '1'
     */
    public function show(string $slug) :object
    {
        return file_success(
            $this->show->make(
                $slug,          #string slug
                $this->page,    #int page
            )
        );
    }

    /**
     * @bodyParam slug string required nombre del libro.
     * @bodyParam page string not_required default '1'
     * @bodyParam count string not_required default '10'
     * @bodyParam search string not_required default null
     */
    public function showFilter(string $slug) :object
    {
        return jsend_success(
            $this->show_filter->make(
                $slug,          #string slug
                $this->page,    #int page
                $this->count,   #int count
                $this->search   #search = null
            )
        );
    }
}
