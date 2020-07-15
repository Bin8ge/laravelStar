<?php

namespace LaravelStar\Router;



class Route
{

    protected $routes = [];

    protected $verbs = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

    protected $namespace;

    public function get($url, $action)
    {
        return $this->addRoute(['GET'], $url, $action);
    }

    public function post($url, $action)
    {
        return $this->addRoute(['GET'], $url, $action);
    }

    public function any($url, $action)
    {
        return $this->addRoute($this->verbs, $url, $action);
    }

    /**
     * Notes:
     * User: bingo
     * Date: 2020/7/15
     * Time: 17:26
     * @param $namespace
     * @return $this
     */
    public function namespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Notes:
     * User: bingo
     * Date: 2020/7/15
     * Time: 17:10
     * @param $methods  请求的类型
     * @param $url      路由标识
     * @param $action   具体地址
     * @return Route
     */
    public function addRoute($methods, $url, $action)
    {
        foreach ($methods as $method) {
            $this->routes[$method][$url] = $action;
        }
        return $this;
    }

    /**
     * Notes: 注册路由
     * User: bingo
     * Date: 2020/7/15
     * Time: 17:16
     * @param $request
     */
    public function register($routes)
    {
        require_once $routes;
    }


    public function dispatch($request)
    {

    }

    public function findRoute($request)
    {

    }

    public function runRoute($request)
    {

    }

}