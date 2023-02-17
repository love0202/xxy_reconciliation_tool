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
            $export_time = $request->input('export_time');
            $sessionKey = trim('export_time' . $export_time);
            $sessionRetArr = app('session')->get($sessionKey, []);

            if ($sessionRetArr) {
                $params['status'] = $sessionRetArr['status'];
                if ($sessionRetArr['status'] == 1) {
                    app('session')->forget($sessionKey);
                }
            } else {
                $params['status'] = 0;
            }
        } catch (Exception $exc) {
            $params['status'] = 0;
        }
        $params['success'] = 1;
        return response()->json($params);
    }
}
