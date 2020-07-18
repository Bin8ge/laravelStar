<?php
namespace LaravelStar\Router;



use LaravelStar\Request\Request;

use LaravelStar\Foundation\Application;
class Route
{

    protected $namespace;
    /**
     * @var Application
     */
    protected $app;

    protected $action;

    protected $controller;
    /**
     * @var Route
     */
    protected $route;


    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }

    /**
     * Notes: 获取所有的路由
     * User: bingo
     * Date: 2020/7/17
     * Time: 16:07
     * @param $path
     * @param $method
     * @return $this
     * @throws \Exception
     */
    public function match($path,$method)
    {
        $routes = $this->app->make('route')->getRoutes();

       foreach ($routes[$method] as $uri=>$route) {
           $uri = ($uri && strpos($uri, '/') !== 0) ? '/' .$uri : $uri;

           if ($path === $uri){
               $this->action = $route;
               break;
           }
       }
       return $this;
    }

    /**
     * Notes: 运行路由
     * User: bingo
     * Date: 2020/7/17
     * Time: 16:07
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
        try {
            if ($this->isControllerAction()) {
                return $this->runController();
            }
            return $this->runCallable();
        } catch (\Exception $e) {
            throw new \Exception('代码运行异常'.$e->getMessage(),300);
        }

    }

    /**
     * Notes: 判断是否为控制器
     * User: bingo
     * Date: 2020/7/17
     * Time: 14:51
     * @return bool
     */
    protected function isControllerAction()
    {
        return is_string($this->action);
    }


    /**
     * Notes: 闭包运行
     * User: bingo
     * Date: 2020/7/17
     * Time: 15:01
     * @return mixed
     */
    protected function runCallable()
    {
        return ($this->action)();
    }

    /**
     * Notes: 运行控制器
     * User: bingo
     * Date: 2020/7/17
     * Time: 15:17
     */
    protected function runController()
    {
        return $this->controllerDispatcher()->dispatcher($this,$this->getController(),$this->getControllerMethod());

    }


    protected function controllerDispatcher()
    {
        return new ControllerDispatcher($this->app);
    }

    /**
     * Notes: 根据路由地址处理控制器方法及方法名
     * User: bingo
     * Date: 2020/7/17
     * Time: 15:20
     */
    protected function parseControllerCallback()
    {
        return explode('@',$this->action);
    }

    /**
     * Notes: 获取控制器
     * User: bingo
     * Date: 2020/7/17
     * Time: 15:35
     */
    protected function getController()
    {
        if (! $this->controller) {
            $class = $this->namespace.'\\'.$this->parseControllerCallback()[0];

            $this->controller = $this->app->make(ltrim($class,'\\'));
        }

        return $this->controller;

    }

    /**
     * Notes: 获取控制器方法
     * User: bingo
     * Date: 2020/7/17
     * Time: 15:35
     * @return mixed
     */
    protected function getControllerMethod()
    {
        return $this->parseControllerCallback()[1];
    }


    public function namespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }





}