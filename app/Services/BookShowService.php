<?php
declare( strict_types = 1 );
namespace App\Services;

use App\Models\BookModel;
use Exception;

/**
 * @group Domain BookShow
 *
 * 
 */
class BookShowService
{
    protected $model;

    public function __construct(BookModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param $slug string |$page int
     *
     * @return string
     */
    public function make(string $slug, int $page) :string
    {
        #si no existe en BD muestro un 404
        if(null === $response = $this->model->show($slug, $page)->first()){

            throw new Exception('No existe la pagina ',404);
        }
        return storage_path("books/{$response['folder']}/pages/{$response['image']}");   
    }
}