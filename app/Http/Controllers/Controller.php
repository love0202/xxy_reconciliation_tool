<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ajax_export_status(Request $request)
    {
        try {
            $export_status_time = $request->input('export_status_time');
            $export_status_time_str = trim('export_status_time_' . $export_status_time);
            $export_status_arr = isset($_SESSION[$export_status_time_str]) ? $_SESSION[$export_status_time_str] : [];

            $params['success'] = 1;
            if ($export_status_arr) {
                $params['export_status'] = $export_status_arr['export_status'];
                if ($export_status_arr['export_status'] == 1) {
                    unset($_SESSION[$export_status_time_str]);
                }
                $count = $request->input('count');
                if ($count > 20000) { //如果数据量超过2W。提供缓冲3S下载时间；
                    sleep(3);
                }
            } else {
                $params['export_status'] = 0;
            }
        } catch (Exception $exc) {
            $params['success'] = 1;
            $params['export_status'] = 0;
        }
        return response()->json($params);
    }
}
