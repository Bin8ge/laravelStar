<?php

require_once '../vendor/autoload.php';
use LaravelStar\Foundation\Application;


//use LaravelStar\Test;
//echo (new Test())->index();



//var_dump((new Application())->getBindings());
//var_dump((new Application())->make('db')->find());
var_dump(app('db')->select());