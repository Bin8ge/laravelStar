<?php
namespace LaravelStar\Request;


class Request
{
    protected $method;

    protected $uriPath;

    public function getMethod()
    {
        return $this->method;
    }

    public function getUriPath()
    {

        return $this->uriPath;
    }

    public static function capture()
    {
        $newRequest = self::createBase();

        $newRequest->method = $_SERVER['REQUEST_METHOD'];

        $newRequest->uriPath = $_SERVER['PATH_INFO'];

        return $newRequest;
    }

    public function getPathInfo()
    {

    }

    public static function createBase()
    {
        return new static();
    }
}