<?php

namespace LaravelStar\Router;



use LaravelStar\Foundation\Application;
use LaravelStar\Request\Request;

class Router
{

    protected $routes = [];

    protected $verbs = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

    protected $namespace;
    /**
     * @var \LaravelStar\Foundation\Application
     */
    protected $app;
    /**
     * @var \LaravelStar\Router\Route
     */
    protected $route;

    public function __construct(Application $app =null )
    {
        $this->app = $app;
        $this->route = new Route($app);
    }

    public function get($url, $action)
    {
        return $this->addRoute(['GET'], $url, $action);
    }

    public function post($url, $action)
    {
        return $this->addRoute(['POST'], $url, $action);
    }

    public function any($url, $action)
    {
        return $this->addRoute($this->verbs, $url, $action);
    }


    /**
     * Notes:
     * User: bingo
     * Date: 2020/7/15
     * Time: 17:10
     * @param $methods  请求的类型
     * @param $url      路由标识
     * @param $action   具体地址
     * @return Router
     */
    public function addRoute($methods, $url, $action)
    {
        foreach ($methods as $method) {
            $this->routes[$method][$url] = $action;
        }
        return $this;
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
        $this->route->namespace($namespace);
        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
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


    //-------------------------------------
    //------ 根据request对象处理用户请求 ----
    //-------------------------------------

    public function dispatch(Request $request)
    {
        return $this->runRoute($request,$this->findRoute($request));

    }

    //-------------------------------------
    //------  查找路由                ------
    //-------------------------------------
    public function findRoute(Request $request)
    {
        $route = $this->route->match($request->getUriPath(),$request->getMethod());

        $this->app->instance(Route::class,$route);

        return $route;

    }

    //-------------------------------------
    //------  运行路由                ------
    //-------------------------------------
    public function runRoute(Request $request,Route $route)
    {
       return  $this->route->run();
    }

}