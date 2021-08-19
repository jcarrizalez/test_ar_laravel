<?php

namespace Tests;

use Closure;
use ArgumentCountError;
use TypeError;
use Throwable;
use \Faker\Factory;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function faker()
    {
        return Factory::create();
    }
    
    public function mock($class)
    {
        return \Mockery::mock("overload:$class");
    }
    
    public function isErrorArguments(Throwable $e)
    {
        $next = 0;
        if('evalArguments'==$this->evalArguments($e, null))
        {
            $next = 1;
        }
        return $next;
    }
    public function evalArguments(Throwable $e, $eval)
    {   
        if($e instanceof TypeError || $e instanceof ArgumentCountError){
            $eval = 'evalArguments';
        }
        return $eval;
    }
}