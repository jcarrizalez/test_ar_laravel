<?php 
declare( strict_types = 1 );
namespace App\Shared;

use Cache AS BaseCache;

class Cache
{
    public function get($key)
    {
    	return BaseCache::get($key);
    }

    public function put($key, $data, $minutes = 60)
    {
    	BaseCache::put($key, $data, $minutes);
    }
}