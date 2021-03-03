<?php
/**
 * 快排
 * @param array $array
 * @return array
 */
function query_sort(array $array) :array{
    //判断数组元素个数
    $length = count($array);
    if ( $length <=1 ) return $array;
    //
    $left = [];
    $right = [];
    for ($i=1;$i<$length;$i++){
        if($array[0]<$array[$i]){
            $right[] = $array[$i];
        }else{
            $left[] = $array[$i];
        }
    }
    /*****11***/
    /* echo '-----start1-----<br>';
     var_dump($left);
     var_dump($right);
     echo '------end1-----<br>';*/
    $a = 1;
    /*****11***/
    $left = query_sort($left);
    $right = query_sort($right);
    echo '------start2-----<br>';
    var_dump($left);
    var_dump($right);
    echo '------end222-----<br>';
    var_dump(array_merge($left,[$array[0]],$right));
    echo $a++;
    echo '<br/>';
    return array_merge($left,[$array[0]],$right);
}


/**
 * 冒泡
 * @param array $arr
 * @return array
 */
function bubble(array $arr):array{
    $length = count($arr);
    if ($length <= 1) return $arr;

    for ($i=0;$i<$length-1;$i++){
        for($j=0;$j<$length-1-$i;$j++){
            if($arr[$j]>$arr[$j+1]){
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $tmp;
            }
        }
    }
    return $arr;

}

/**
 * 二分查找算法
 * @param array $arr 待查找区间
 * @param int $number 查找数
 * @return int        返回找到的键
 */
function binary_search($arr, $number) {
    // 非数组或者数组为空，直接返回-1
    if (!is_array($arr) || empty($arr)) {
        return -1;
    }
    // 初始变量值
    $len = count($arr);
    $lower = 0;
    $high = $len - 1;
    // 最低点比最高点大就退出
    while ($lower <= $high) {
        // 以中间点作为参照点比较
        $middle = intval(($lower + $high) / 2);
        if ($arr[$middle] > $number) {
            // 查找数比参照点小，舍去右边
            $high = $middle - 1;
        } else if ($arr[$middle] < $number) {
            // 查找数比参照点大，舍去左边
            $lower = $middle + 1;
        } else {
            // 查找数与参照点相等，则找到返回
            return $middle;
        }
    }
    // 未找到，返回-1
    return -1;
}

/**
 * 二分法
 * @param array $arr
 * @param int $number
 * @return int
 */
function binary_sear(array $arr,int $number) {
    $length = count($arr);
    $lower = 0;
    $height = $length-1;

    while ($lower <= $height) {
        $middle = intval(($height + $lower)/2);

        var_dump($middle);
        if($arr[$middle]>$number) {
            $height = $middle + 1;
        }elseif($arr[$middle]<$number){
            $lower = $middle-1;
        }else{
            return $middle;
        }
    }
    // 未找到，返回-1
    return -1;
}


/**
 * 二分法 递归
 * @param $arr
 * @param $number
 * @param $lower
 * @param $high
 * @return int
 */
function binary_search_recursion(&$arr, $number, $lower, $high) {
    // 以区间的中间点作为参照点比较
    $middle = intval(($lower + $high) / 2);
    // 最低点比最高点大就退出
    if ($lower > $high) {
        return -1;
    }
    if ($number > $arr[$middle]) {
        // 查找数比参照点大，舍去左边继续查找
        return binary_search_recursion($arr, $number, $middle + 1, $high);
    } elseif ($number < $arr[$middle]) {
        // 查找数比参照点小，舍去右边继续查找
        return binary_search_recursion($arr, $number, $lower, $middle - 1);
    } else {
        return $middle;
    }
}




$array = [6,5,723,45,7689,4];
//print_r(query_sort($array));
//print_r(bubble($array));
$binary_array = [1,2,3,4,5,6,7,8,9];
print_r(binary_search_recursion($binary_array,6,0,9));