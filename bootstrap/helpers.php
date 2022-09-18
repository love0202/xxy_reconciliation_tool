<?php

if (! function_exists('yxx')) {
    function yxx($data)
    {
        dd($data);
    }
}

if (! function_exists('yxx_path_static')) {
    function yxx_path_static($fileName = '',$path = 'images')
    {
        $file = '';
        if (!empty($fileName)) {
            $file = '/static/' . $path . '/' . $fileName;
        }
        return $file;
    }
}
