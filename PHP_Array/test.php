<?php
//$array =[1, "hello", 1, "world", "hello"];
//print_r(array_count_values($array));

$array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
$array2 = array("a" => "green", "yellow", "red");
$array3 = array("a" => "abc", "red", "orgine");
$result = array_diff_assoc($array1, $array2,$array3);
/*print_r(10 & 1);
print_r(9 & 1);
print_r(8 & 1);
print_r(7 & 1);
print_r(6 & 1);*/

function sum($carry, $item)
{
    $carry += $item;
    return $carry;
}

function product($carry, $item)
{
    $carry *= $item;
    return $carry;
}

$a = array(1, 2, 3, 4, 5);
$x = array();

//var_dump(array_reduce($a, "sum")); // int(15)
//var_dump(array_reduce($a, "product",1)); // int(1200), because: 10*1*2*3*4*5
//var_dump(array_reduce($x, "sum", "No data to reduce")); // string(17) "No data to reduce"
$string = 'abcdef';
$string[2] = '123';

echo $string[2];
echo "------";
echo $string;

explode();  //使用一个字符串分割另一个字符串
explode();  //将一维数组分割成字符串
trim();  //去除左右两边的空格
ltrim(); //去除左边字符串的空格
rtrim(); //去除右边字符串的空格
str_replace(); //字符串替换
strstr();
strlen();



