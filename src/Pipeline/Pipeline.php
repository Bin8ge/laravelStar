<?php

namespace LaravelStar\Pipeline;

use Closure;
use LaravelStar\Foundation\Application;

class Pipeline
{
    protected $app;


    protected $pipes = [];


    protected $passable;

    protected $method = 'handle';


    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * Notes: 启动管道的方法
     * User: bingo
     * Date: 2020/7/18
     * Time: 14:29
     * @param Closure $desctination
     * @return mixed
     */
    public function then(Closure $desctination)
    {
        $pipeline = array_reduce(
            $this->pipes(),
            $this->carry(),
            $desctination
        );
        return $pipeline($this->passable);
    }

    /**
     * Notes: 中间件链表
     * User: bingo
     * Date: 2020/7/18
     * Time: 14:29
     * @return array
     */
    public function pipes()
    {
        return $this->pipes;
    }


    public function through($pipes)
    {
        $this->pipes = is_array($pipes) ? $pipes : func_get_args();
        return $this;
    }

    /**
     * Notes: 管道执行方法
     * User: bingo
     * Date: 2020/7/18
     * Time: 14:30
     * @return \Closure
     */
    public function carry()
    {
       /* return function($stack, $pipe){
            return function() use ($stack, $pipe){
                return $pipe::hander($stack);
            };
        };*/
        return function ($stack, $pipe) {
            return function ($passable) use ($stack, $pipe) {

                try {

                    if (is_callable($pipe)) {
                        return $pipe($passable, $stack);
                    }

                    if (! is_object($pipe)) {
                        $pipe = $this->app->make($pipe);
                        $parameters = [$passable, $stack];
                    }


                    return  method_exists($pipe, $this->method)
                        ? $pipe->{$this->method}(...$parameters)
                        : $pipe(...$parameters);
                } catch (Throwable $e) {
                }
            };
        };

    }


    /**
     * Notes: 设置通过管道发送的对象。
     * User: bingo
     * Date: 2020/7/18
     * Time: 14:37
     * @param $passable
     * @return $this
     */
    public function send($passable)
    {
        $this->passable = $passable;

        return $this;
    }





}