<?php
use Illuminate\Support\Facades\Route;

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
            $file = '/static/' . $path . '/' . $fileName;
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
    function get_yxx_menu($webProject = '')
    {
        $data = [];
        $yxxMenu = config('yxx_menu');
        $routeName = Route::currentRouteName();
        foreach ($yxxMenu as $menu) {
            if ($menu['routeName'] == $routeName){
                $menu['active'] = 1;
            }
            if (empty($webProject)) {
                if ($menu['show'] == 1) {
                    $data[] = $menu;
                }
            } else {
                if ($menu['show'] == 2) {
                    $data[] = $menu;
                }
            }
        }
//        dd($yxxMenu);
        return $data;
    }
}
