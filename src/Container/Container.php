<?php

namespace LaravelStar\Container;
use Closure;
use ArrayAccess;
class Container implements ArrayAccess
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
//        if (!$this->has($abstract)) {
//            throw new \Exception('解析的对象不存在'.$abstract,500);
//        }

        //判断是否创建过单例
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $object = $this->getConrete($abstract);





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
        if ($this->has($abstract) && $this->bindings[$abstract]['shared']) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }


    public function getConrete($abstract)
    {
        if ($this->has($abstract)) {
            $abstract = $this->bindings[$abstract]['concrete'];
        }
        return $abstract;

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

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return bool true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param $key
     * @return mixed Can return all value types.
     * @throws \Exception
     * @since 5.0.0
     */
    public function offsetGet($key)
    {
       return $this->make($key);
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}