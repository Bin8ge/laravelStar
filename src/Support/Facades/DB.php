<?php


namespace LaravelStar\Support\Facades;


class DB extends Facade
{
    protected static function getFacadeAccessor()
    {
       return \LaravelStar\Databases\Oracle::class;
//       return 'db';
    }
}