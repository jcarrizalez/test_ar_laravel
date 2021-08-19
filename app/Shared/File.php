<?php 
declare( strict_types = 1 );
namespace App\Shared;

use Illuminate\Support\Facades\File as FileFacade;

class File
{
    public static function directories($path)
    {
        return FileFacade::directories($path);
    }

    public static function exists($file) :bool
    {
        return FileFacade::exists($file);
    }
}