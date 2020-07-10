<?php


use LaravelStar\Container\Container;
use LaravelStar\Foundation\Application;

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {

            return Application::getInstance();
        }

        return Application::getInstance()->make($abstract, $parameters);
    }
}