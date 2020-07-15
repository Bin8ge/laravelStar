<?php
namespace LaravelStar\Foundation\Http;
use LaravelStar\Contracts\Http\Kernel as Contracts;
use LaravelStar\Foundation\Application;

#处理http请求的类
class Kernel implements Contracts
{
    /**
     * @var \ LaravelStar\Foundation\Application
     */
    protected $app;

    protected $bootstrappers = [
        \LaravelStar\Foundation\Bootstrap\RegisterFacades::class,
        \LaravelStar\Foundation\Bootstrap\LoadConfiguration::class,
        \LaravelStar\Foundation\Bootstrap\RegisterProviders::class,
        \LaravelStar\Foundation\Bootstrap\BootProviders::class,

    ];


    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }


    public function handle($request = null)
    {
        $this->sendRequestThroughRouter($request);

    }

    public function sendRequestThroughRouter($request= null)
    {
        $this->bootstrap();
    }

    /**
     * Notes: 加载框架驱动的方法
     * User: bingo
     * Date: 2020/7/13
     * Time: 15:34
     */
    public function bootstrap()
    {
//       $this->app->bootstrapWith($this->bootstrappers);
        foreach ($this->bootstrappers as $bootstrapper) {
            $this->app->make($bootstrapper)->bootstrap($this->app);
        }
    }

}