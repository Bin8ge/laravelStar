<?php
namespace LaravelStar\Databases;

use LaravelStar\Contracts\Databases\Db;

class Oracle implements Db
{
//    public function find()
//    {
//        return 'Oracle';
//    }

    public function select()
    {
        return 'Oracle';
    }
}