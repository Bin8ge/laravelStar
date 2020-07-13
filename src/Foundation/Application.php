<?php
namespace LaravelStar\Foundation;


use LaravelStar\Container\Container;


class Application extends Container
{
    protected $basePath;

    public function __construct($basePath = null)
    {
        if ($basePath) {
            //设置项目地址
            $this->setBasePath($basePath);
        }

        //注册核心的应用到容器中
        $this->registerBaseBindings();
        //注册核心应用服务提供者
        //注册事件 路由 日志
//        $this->registerBaseServiceProviders();
        //注册核心应用容器别名
        $this->registerCoreContainerAliases();
        \LaravelStar\Support\Facades\Facade::setFacadeApplication($this);
    }


    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

    }

    public function getBasePath()
    {
        return $this->basePath;
    }

    protected function registerBaseBindings()
    {
        //设置自己为单例实例对象
        static::setInstance($this);
        $this->instance('app', $this);
    }

    public function registerCoreContainerAliases()
    {
        $binds = [
            'config' => \LaravelStar\Config\Config::class,
            'cookie' => \LaravelStar\Cookie\Cookie::class,
            'db' => \LaravelStar\Databases\Oracle::class
//            'db' => [
//                \LaravelStar\Database\Oracle::class,
//                \LaravelStar\Contracts\Database\Db::class
//            ],

        ];

        foreach ($binds as $key => $bind) {
            $this->bind($key,$bind);
        }

    }


    public function bootstrapWith(array $bootstrappers)
    {
        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
    }

}