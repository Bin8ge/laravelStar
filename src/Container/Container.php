<?php

namespace LaravelStar\Container;
use Closure;
class Container
{
    protected static $instance;
    //容器
    protected  $bindings = [];

    /**
     * 共享容器 对容器进行单例的创建和运用
     * @var array
     */
    protected  $instances = [];

    //别名
//    protected $aliases = [];
//    protected $abstractAliases = [];

    public function __construct()
    {
         //self::setInstance($this);
    }

    /**
     * Notes:
     * User: bingo
     * Date: 2020/7/7
     * Time: 17:34
     * @param $abstract  容器的标识
     * @param $concrete  实例化对象/闭包/对象地址
     * @param bool $shared
     */
    public function bind($abstract,$concrete,$shared = false )
    {

        $this->bindings[$abstract]['concrete'] = $concrete;
        $this->bindings[$abstract]['shared']  = $shared;

    }

    /**
     * Notes: 单例
     * User: bingo
     * Date: 2020/7/9
     * Time: 10:59
     * @param $abstract
     * @param null $concrete
     */
    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * Notes:
     * User: bingo
     * Date: 2020/7/7
     * Time: 17:41
     * @param $abstract 容器的标识
     * @param array $parameters
     * @return mixed
     * @throws \Exception
     */
    public function make($abstract,$parameters = [])
    {
          return $this->resolve($abstract,$parameters);
    }

    /**
     * Notes:
     * User: bingo
     * Date: 2020/7/7
     * Time: 17:41
     * @param $abstract
     * @param array $parameters
     * @param bool $shared
     * @return mixed
     * @throws \Exception
     */
    public function resolve($abstract, $parameters = [])
    {
        if (!$this->has($abstract)) {
            throw new \Exception('解析的对象不存在'.$abstract,500);
        }

        //判断是否创建过单例
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $object = $this->bindings[$abstract]['concrete'];



        //判断是否是闭包
        if ($object instanceof Closure){
            //如果是 执行
            return $object();
        }

        #判断是否为一个object 对象
        if(!is_object($object)) {
            $object = new $object(...$parameters);
        }

        # 判断是否为单例
        if ($this->bindings[$abstract]['shared']) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * Notes: 判断对象是否存在
     * User: bingo
     * Date: 2020/7/9
     * Time: 11:27
     * @param $abstract
     * @return bool
     */
    public function has($abstract)
    {
        return isset($this->bindings[$abstract]['concrete']) || isset($this->instances[$abstract]);
    }


    /**
     * Notes: 获取容器
     * User: bingo
     * Date: 2020/7/7
     * Time: 17:53
     * @return array
     */
    public function getBindings()
    {
        return $this->bindings;

    }

    /**
     * Notes:
     * User: bingo
     * Date: 2020/7/9
     * Time: 16:50
     * @param $abstract  标识
     * @param $instance  实力对象
     */
    public function instance($abstract,$instance)
    {
        $this->removeBindings($abstract);
        $this->instances[$abstract] = $instance;

    }

    protected function removeBindings($abstract)
    {
        if(!isset($this->bindings[$abstract])){
            return ;
        }

        unset($this->bindings[$abstract]);
    }

    public static function setInstance($container = null)
    {
        return static::$instance = $container;
    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

}