<?php
declare( strict_types = 1 );
namespace App\Services;

use App\Models\BookModel;
use App\Shared\Cache;
use App\Services\BookShowService;

use Tests\TestCase;
use Exception;
use Throwable;

/**
 * @group UnitTest BookShow
 *
 * 
 */
class BookShowServiceUnitTest extends TestCase
{
    protected $model;
    protected $cache;

    public function __construct()
    {
        parent::__construct();

        $this->model = $this->mock(BookModel::class);
        $this->cache = $this->mock(Cache::class);
    }

    private function newClass()
    { 
        return new BookShowService(
            $this->model,
            $this->cache
        );
    }

    public function test_exception_arguments_null()
    {   
        $cant  = 4;
        $class = $this->newClass();
        try {
            $class->make();
        }catch (Throwable $e){
            $cant -= $this->isErrorArguments($e);
        }
        try {
            $class->make('string', 'string');
        }catch (Throwable $e){
            $cant -= $this->isErrorArguments($e);
        }
        try {
            $class->make('string', null);
        }catch (Throwable $e){
            $cant -= $this->isErrorArguments($e);
        }
        try {
            $class->make(1,1);
        }catch (Throwable $e){
            $cant -= $this->isErrorArguments($e);
        }
        $this->assertEquals(0, $cant);
    }


    public function test_exist_in_cache()
    {
        $this->cache->shouldReceive('get')->andReturn('este_es_el_path');

        $result = ($this->newClass())->nake('string', 1);
        $this->assertTrue($result);
    }

    public function test_exist_in_bd()
    {
        $this->cache->shouldReceive('get')->andReturn(null);
        $this->model->shouldReceive('show')->andReturn((object)[
            'folder'=> 'folder',
            'image'=> 'image',
        ]);

        $result = ($this->newClass())->nake('string', 1);
        $this->assertTrue($result);
    }
}