<?php
namespace LaravelStar\Foundation;

class ProviderRegister
{
    protected $app;

    public function __construct(Application $app = null)
    {
        $this->app = $app;
    }


    #加载服务提供者的方法
    public function load($providers)
    {
        foreach ($providers as $key => $provider) {
            $this->register($provider);
        }

    }

    #  注册操作
    protected function register($provider)
    {
        # 解析服务提供者的注册方法
        if (is_string($provider)) {
            $provider = $this->resolveProvider($provider);
        }

        $provider->register();


        if (property_exists($provider, 'bindings')) {
            foreach ($provider->bindings as $key => $value) {
                $this->app->bind($key, $value);
            }
        }

        if (property_exists($provider, 'singletons')) {
            foreach ($provider->singletons as $key => $value) {
                $this->app->singleton($key, $value);
            }
        }

        $this->app->marASRegistered($provider);

    }

    protected function resolveProvider($provider)
    {
        return new $provider($this->app);
    }
}