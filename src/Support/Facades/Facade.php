<?php
namespace LaravelStar\Support\Facades;

abstract class Facade
{


    protected static $resolvedInstance;
    protected static $app;

    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     * @throws \Exception
     */
    protected static function getFacadeAccessor()
    {
        throw new \Exception('没有指明facade',500);
    }

    public static function resolveFacadeInstance($name)
    {
        #判断是否为对象
        if (is_object($name)) {
            return $name;
        }



        # 判断是否之前创建过
        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }
        # 解析实例对象
//        return static::$resolvedInstance[$name] = app($name);
//        var_dump(static::$app);exit;

//        return static::$resolvedInstance[$name] = static::$app[$name];
        if (static::$app) {
//            return static::$resolvedInstance[$name] = static::$app[$name];
            return static::$resolvedInstance[$name] = static::$app[$name];
        }

    }

    /**
     * Notes: 设置 Application  instance
     * User: bingo
     * Date: 2020/7/10
     * Time: 15:02
     * @param $app
     */
    public static function setFacadeApplication($app)
    {
        static::$app = $app;
    }

    public static function getFacadeApplication()
    {
        return static::$app;
    }


    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (! $instance) {
            throw new \Exception('sorry ,灭有找到',500);
        }

        return $instance->$method(...$args);
    }

}