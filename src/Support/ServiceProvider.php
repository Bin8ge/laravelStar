<?php

namespace LaravelStar\Support;

use LaravelStar\Foundation\Application;
class ServiceProvider
{
    protected $app;

    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }

    public function register()
    {
        //
    }

    public function boot()
    {

    }

}