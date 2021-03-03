<?php

/*
1 current();  //读取指针位置的内容
2 key();      //读取当前指针指向内容的索引值
3 next();     //将数组中的内部指针指向下一单元
4 prev();     //将数组内部指针倒回一位
5 end();      //将数组内部指针指向最后一个元素
6 reset();    //将目前指针指向第一个索引位置
*/

$info = [
    'a' => 'this is a',
    'b' => 'this is b',
    'c' => 'this is c',
    'd' => 'this is d'
];

//echo key($info) . ':' . current($info) . '<br>';
//
//next($info);
//echo key($info) . ':' . current($info) . '<br>';
//
//end($info);
//echo key($info) . ':' . current($info) . '<br>';
//
//reset($info);
//echo key($info) . ':' . current($info) . '<br>';

$input_array = [[array("FirSt" => 1, "SecOnd" => 4)]];
print_r(array_change_key_case($input_array, CASE_UPPER));


//array_change_key_case(); #将数组的键名全部改为大写或小写
//array_chunk(); #将一个数组分割成多个
$abc = array(
    [
        'id' => 5342,
        'first_name' => 'Jane',
        'last_name' => 'Jones',
    ]

);
array_column($abc,'id','last_name'); #返回数组某一列

array_combine ( array $keys , array $values ) : array; //将一个数组的值作为间  另一个数组的值作为 值  组成新的数组

array_count_values(array $array) : array; //统计数组中的值出现过的次数

array_diff_assoc(array $array ,...array $array):array   //第一个数组元素跟后面的多个数组元素 的差集

array_diff_key(array $array ,...array $array):array  //第一个数组键跟后面的数组比较  也是差集

array_diff(array $array ,...array $array):array;  //比较数组的差集  可以跟多个数组比较

array_fill_keys() // 使用指定的键和值填充数组
array_fill();      //用给定的值填充数组
array_combine();   //一个数组当值 另一个数组当键 组成新的数组
array_reduce();    //用迭代的方式将数组换位单一的值

array_filter() ; //用回调函数过滤数组单元
array_map($callback,$array);     //数组每个元素都调用 回调函数
array_walk();

array_flip() ;// 交换数组的键值对

array_intersect(array $array  ...array $array) :array  //计算两个数组的交集  不比较键
array_intersect_key(array $array  ...array $array) : array  //使用键名比较数组的交集
array_intersect_assoc(array $array  ...array $array)//带索引检查 两个数组的交集
array_intersect_uassoc(); //带索引检查计算数组的交集，用回调函数比较索引
array_intersect_ukey();  //用回调函数比较键名来计算数组的交集

array_key_exists(); //检查数组键名或索引 是否存在
array_keys();     //返回数组部分key 或全部
array_key_first(); //获取指定数组的第一个键值
array_key_last(); //获取指定数组的最后一个键值

array_merge(array $array,...$array ) :array //合并一个或多个数组
array_merge_recursive(array $array ,...$array);  //递归的合并一个或多个数组


array_replace(array $array ,array $array);  //递归替换 第一个数组元素  如果被替换的数组有多余元素 将被保留
array_replace_recursive(); //直接全部替换对应的元素

array_multisort(); //  对数组排序
array_pad(); //指定一个长度值填充进数组

array_push() ; //往数组队尾加元素
array_unshift(); //在数组开头 添加一个或多个数组
array_pop(); //弹出数组最后一个元素
array_shift(); //将数组开头的单元移除数组
array_rand(); // 从数组中随机取出一个值

array_product();  //计算数组内所有值的乘积
array_reverse(); //返回单元顺序相反的数组

array_search(); //给定一个值  返回对应值的键名

array_unique(); //一处数组中重复的值

array_values();//返会数组中所有的值
is_array();  //判断是否是数组
in_array();   // 判断数组中是否存在某个值

array_slice();  //从数组中取出一段

array_sum();  //数组之和



