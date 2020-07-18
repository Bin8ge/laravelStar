<?php
namespace LaravelStar\Router;


use LaravelStar\Foundation\Application;



class ControllerDispatcher
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Notes: 控制器分发
     * User: bingo
     * Date: 2020/7/17
     * Time: 15:26
     * @param Route $route
     * @param $controller  控制器地址
     * @param $method      控制器的里面的方法
     * @return mixed
     */
    public function dispatcher(Route $route, $controller , $method )
    {
        return $controller->{$method}();
    }



}