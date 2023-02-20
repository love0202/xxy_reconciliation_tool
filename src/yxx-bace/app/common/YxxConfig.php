<?php

namespace app\common;

class YxxConfig
{
    static function list($name)
    {
        $list = [];
        $yxxConfigArray = config('yxx');
        if (isset($yxxConfigArray[$name])) {
            if (is_array($yxxConfigArray[$name])) {
                foreach ($yxxConfigArray[$name] as $key => $value) {
                    $list[$value['value']] = $value['name'];
                }
                return $list;
            } else {
                dd($name . '-不是一个数组');
            }
        } else {
            dd($name . '-不存在');
        }
    }

    static function name($name, $key)
    {
        $yxxConfigArray = config('yxx');
        if (isset($yxxConfigArray[$name])) {
            if (isset($yxxConfigArray[$name][$key])) {
                return $yxxConfigArray[$name][$key]['name'];
            } else {
                $data = [];
                foreach ($yxxConfigArray[$name] as $v) {
                    $data[$v['value']] = $v['name'];
                }
                if (isset($data[$key])) {
                    return $data[$key];
                }else{
                    dd($key . '-不存在');
                }
            }
        } else {
            dd($name . '-不存在');
        }
    }

    static function value($name, $key)
    {
        $yxxConfigArray = config('yxx');
        if (isset($yxxConfigArray[$name])) {
            if (isset($yxxConfigArray[$name][$key])) {
                return $yxxConfigArray[$name][$key]['value'];
            } else {
                dd($key . '-不存在');
            }
        } else {
            dd($name . '-不存在');
        }
    }
}