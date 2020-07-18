<?php
namespace LaravelStar\Foundation\Http;
use LaravelStar\Contracts\Http\Kernel as Contracts;
use LaravelStar\Foundation\Application;
use LaravelStar\Pipeline\Pipeline;
use LaravelStar\Request\Request;

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


    public function handle(Request $request)
    {
        return $this->sendRequestThroughRouter($request);

    }

    /**
     * Notes: 根据请求分发到响应的路由 并且输出运行结果
     * User: bingo
     * Date: 2020/7/16
     * Time: 16:32
     * @param Request $request
     * @return
     * @throws \Exception
     */
    public function sendRequestThroughRouter(Request $request)
    {
        # 加载框架的驱动方法
        $this->bootstrap();

        $this->app->instance('request', $request);
        //return $this->app->make('route')->dispatch($request);

        return (new Pipeline($this->app))
            ->send($request)
            ->through($this->middleware)
            ->then($this->dispatchToRouter());
    }


    protected function dispatchToRouter()
    {
        return function ($request) {
            $this->app->instance('request', $request);

             return $this->app->make('route')->dispatch($request);
        };
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