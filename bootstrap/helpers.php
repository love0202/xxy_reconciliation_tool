<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Common\WebProject;

if (!function_exists('yxx')) {
    function yxx($data)
    {
        dd($data);
    }
}

if (!function_exists('yxx_path_static')) {
    function yxx_path_static($fileName = '', $path = 'images')
    {
        $file = '';
        if (!empty($fileName)) {
            $file = config('app.url') . '/static/' . $path . '/' . $fileName;
        }
        return $file;
    }
}

if (!function_exists('make_guid')) {
    function make_guid($long = false, $oldguid = null)
    {
        if (strlen($oldguid) != 32) {
            static $lastGuid = '';
            $uid = uniqid("", true);
            $data = sha1(time() . mt_rand(1, 1000000)) . microtime(true) . getmypid();
            $guid = strtoupper(hash('ripemd128', $uid . $lastGuid . md5($data)));
            $lastGuid = $guid;
        } else {
            $guid = strtoupper($oldguid);
        }

        if ($long) {
            $sep = chr(45);
            $new = substr($guid, 0, 8) . $sep . substr($guid, 8, 4) . $sep
                . substr($guid, 12, 4) . $sep . substr($guid, 16, 4) . $sep . substr($guid, 20, 12);
            $guid = $new;
        }
        $ret = strtoupper($guid);
        return $ret;
    }
}

if (!function_exists('get_yxx_menu')) {
    function get_yxx_menu()
    {
        $webProject = WebProject::getProject();
        $data = [];
        $yxxMenu = config('yxx_menu');
        $routeName = Route::currentRouteName();
        foreach ($yxxMenu as $key1 => $value1) {
            foreach ($value1['items'] as $key2 => $value2) {
                if ($value2['routeName'] == $routeName) {
                    $value1['active'] = 1;
                }
            }
            if (empty($webProject)) {
                if ($value1['show'] == 1) {
                    $data[] = $value1;
                }
            } else {
                if ($value1['show'] == 2) {
                    $data[] = $value1;
                }
            }
        }
        return $data;
    }
}

if (!function_exists('get_yxx_left_menu')) {
    function get_yxx_left_menu()
    {
        $data = [];
        $k1 = 0;
        $yxxMenu = config('yxx_menu');
        $routeName = Route::currentRouteName();
        foreach ($yxxMenu as $key1 => &$value1) {
            foreach ($value1['items'] as $key2 => $value2) {
                if (isset($value2['isHidden']) && isset($value2['parentId'])) {
                    if ($value2['routeName'] == $routeName) {
                        $value1['items'][$value2['parentId']]['active'] = 1;
                        $value1['active'] = 1;
                        $k1 = $key1;
                    }
                    unset($value1['items'][$key2]);
                } else {
                    if ($value2['routeName'] == $routeName) {
                        $value1['items'][$key2]['active'] = 1;
                        $value1['active'] = 1;
                        $k1 = $key1;
                    }
                }
            }
        }
        $data = isset($yxxMenu[$k1]['items']) ? $yxxMenu[$k1]['items'] : [];
        return $data;
    }
}

if (!function_exists('get_yxx_title')) {
    function get_yxx_title($sep = ' | ')
    {
        $yxxTitle = '';
        $yxxMenu = config('yxx_menu');
        $routeName = Route::currentRouteName();
        foreach ($yxxMenu as $key1 => &$value1) {
            foreach ($value1['items'] as $key2 => $value2) {
                if ($value2['routeName'] == $routeName) {
                    $yxxTitle = $value1['name'] . $sep . $value1['items'][$key2]['name'];
                }
            }
        }
        return $yxxTitle;
    }
}

if (!function_exists('yxx_limit')) {
    function yxx_limit($value, $limit = 20, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}

// 字典相关方法 - 获取字典数组 yxx_dict_list('THEME_TYPE')
if (!function_exists('yxx_dict_list')) {
    function yxx_dict_list($dictKey)
    {
        $data = [];
        $dictList = config('yxx_dict.' . $dictKey);
        if (!is_null($dictList)) {
            foreach ($dictList as $k => $v) {
                $data[$v['value']] = $v['name'];
            }
        }
        return $data;
    }
}
// 字典相关方法 - 获取字典key对应的值 yxx_dict_value('THEME_TYPE','T1')
if (!function_exists('yxx_dict_value')) {
    function yxx_dict_value($dictKey, $key)
    {
        $value = '';
        $dictList = config('yxx_dict.' . $dictKey);
        if (!is_null($dictList)) {
            foreach ($dictList as $k => $v) {
                if ($k == $key) {
                    $value = $v['value'];
                }
            }
        }
        return $value;
    }
}
// 字典相关方法 - 获取字典值对应的名称 yxx_dict_name('THEME_TYPE','T1') 或者 yxx_dict_name('THEME_TYPE','1')
if (!function_exists('yxx_dict_name')) {
    function yxx_dict_name($dictKey, $value)
    {
        $name = '';
        $dictList = config('yxx_dict.' . $dictKey);
        if (!is_null($dictList)) {
            foreach ($dictList as $k => $v) {
                if ($k == $value || $v['value'] == $value) {
                    $name = $v['name'];
                }
            }
        }
        return $name;
    }
}
