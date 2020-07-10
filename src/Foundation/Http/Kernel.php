<?php
namespace LaravelStar\Foundation\Http;
use LaravelStar\Contracts\Http\Kernel as Contraxts;
use Illuminate\Contracts\Foundation\Application;
class Kernel implements Contraxts
{
    protected $app;

    protected $bootstrappers = [

    ];

    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }


    public function handler($request = null)
    {
        $this->sendRequestThroughRouter();

    }

    public function sendRequestThroughRouter($request)
    {
        $this->bootstrap();
    }

    public function bootstrap($request)
    {

    }
}