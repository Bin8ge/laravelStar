<?php
namespace LaravelStar\Config;

class Config
{

    protected $items = [];


    public function phpParser($configPath)
    {
        # 找到文件
        $files = scandir($configPath);

        $data = null;


        //读取文件
        foreach ($files as $key => $file ) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            # 获取文件名
            $filename = stristr($file, '.php',true);

            # 读取文件信息
            $data[$filename] = include $configPath."/".$file;
        }

        $this->items = $data;

        return $this;
    }


    public function get($keys)
    {
        $data = $this->items;


        foreach (explode('.',$keys) as $key => $value) {
            $data = $data[$value];
        }

        return $data;
    }

    public function all()
    {
        return $this->items;
    }

}