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
        $yxxTitle = '';
        $k1 = 0;
        $yxxMenu = config('yxx_menu');
        $routeName = Route::currentRouteName();
        foreach ($yxxMenu as $key1 => &$value1) {
            foreach ($value1['items'] as $key2 => $value2) {
                if (isset($value2['isHidden']) && $value2['isHidden']) {
                    unset($value1['items'][$key2]);
                }
                if (is_array($value2['routeName'])) {
                    if (in_array($routeName, $value2['routeName'])) {
                        $value1['items'][$key2]['active'] = 1;
                        $value1['active'] = 1;
                        $k1 = $key1;
                    }
                } else {
                    if ($value2['routeName'] == $routeName) {
                        $value1['items'][$key2]['active'] = 1;
                        $value1['active'] = 1;
                        $k1 = $key1;
                        $yxxTitle = $value1['name'] . '-' . $value1['items'][$key2]['name'];
                    }
                }
            }
        }
        $data = $yxxMenu[$k1]['items'];
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
                if (is_array($value2['routeName'])) {
                    if (in_array($routeName, $value2['routeName'])) {
                        $yxxTitle = $value1['name'] . $sep . $value1['items'][$key2]['name'];
                    }
                } else {
                    if ($value2['routeName'] == $routeName) {
                        $yxxTitle = $value1['name'] . $sep . $value1['items'][$key2]['name'];
                    }
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
