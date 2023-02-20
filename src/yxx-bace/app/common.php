<?php
// 应用公共文件


if (!function_exists('yxx_config_list')) {
    function yxx_config_list($name, $keyName = 'name')
    {
        $list = [];
        $yxxConfigArray = config('yxx');
        if (isset($yxxConfigArray[$name])) {
            if (is_array($yxxConfigArray[$name])) {
                foreach ($yxxConfigArray[$name] as $key => $value) {
                    $list[$value['value']] = $value[$keyName];
                }
                return $list;
            } else {
                dd($name . '-不是一个数组');
            }
        } else {
            dd($name . '-不存在');
        }
    }
}

if (!function_exists('yxx_config_name')) {
    function yxx_config_name($name, $key)
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
                } else {
                    dd($key . '-不存在');
                }
            }
        } else {
            dd($name . '-不存在');
        }
    }
}

if (!function_exists('yxx_config_ename')) {
    function yxx_config_ename($name, $key)
    {
        $yxxConfigArray = config('yxx');
        if (isset($yxxConfigArray[$name])) {
            if (isset($yxxConfigArray[$name][$key])) {
                return $yxxConfigArray[$name][$key]['ename'];
            } else {
                $data = [];
                foreach ($yxxConfigArray[$name] as $v) {
                    $data[$v['value']] = $v['ename'];
                }
                if (isset($data[$key])) {
                    return $data[$key];
                } else {
                    dd($key . '-不存在');
                }
            }
        } else {
            dd($name . '-不存在');
        }
    }
}

if (!function_exists('yxx_config_value')) {
    function yxx_config_value($name, $key)
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
