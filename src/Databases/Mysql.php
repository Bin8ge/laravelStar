<?php
namespace LaravelStar\Databases;

use LaravelStar\Contracts\Databases\Db;

class Mysql implements Db
{
//    public function find()
//    {
//        return 'Mysql';
//    }

    public function select()
    {
        return 'Mysql';
    }
}