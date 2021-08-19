<?php
declare( strict_types = 1 );
namespace App\Services;

use App\Models\BookModel;
use App\Shared\Cache;
use Exception;

/**
 * @group Domain BookShow
 *
 * 
 */
class BookShowService
{
    protected $model;
    protected $cache;

    public function __construct(
        BookModel $model, 
        Cache $cache
    )
    {
        $this->model = $model;
        $this->cache = $cache;
    }

    /**
     * @param $slug string |$page int
     *
     * @return string
     */
    public function make(string $slug, int $page) :string
    {
        $cache = $slug.$page;

        #si existe en Cache se hace el return
        if(null !== $response = $this->cache->get($cache)){

            return $response;
        }
        #si no existe en BD muestro un 404
        if(null === $response = $this->model->show($slug, $page)->first()){

            throw new Exception('No existe la pagina ',404);
        }
        $file = storage_path("books/{$response['folder']}/pages/{$response['image']}");

        if(!file_exists($file)){

            throw new Exception('No existe el archivo ',404);
        }

        #dejo en cache
        $this->cache->put($cache, $file);

        return $file;
    }
}