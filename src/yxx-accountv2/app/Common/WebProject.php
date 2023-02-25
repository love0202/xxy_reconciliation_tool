<?php

namespace App\Common;

use Illuminate\Support\Facades\Auth;
use App\Models\Project\Project;

class WebProject
{
    const COOKEY_NAME = 'currProject';
    const SESSION_NAME = 'currProject';
    static $project;

    public static function setProjectId($projectId)
    {
        $userInfo = Auth::user();
        session()->put(static::SESSION_NAME, $projectId);
        cookie(static::COOKEY_NAME, $projectId . ',' . $userInfo->id, time() + 30 * 24 * 3600);
    }

    public static function enter($projectId)
    {
        if (!$projectId instanceof Project)
            $projectInfo = Project::find($projectId);
        else
            $projectInfo = $projectId;
        if (!$projectInfo)
            return false;
        static::setProjectId($projectInfo->id);
        return true;
    }

    public static function quit()
    {
        session()->put(static::SESSION_NAME, null);
        cookie(static::COOKEY_NAME, null, time());
    }

    public static function getProjectId()
    {
        $ret = null;
        $ret = session(static::SESSION_NAME);
        if (!$ret) {
            $cookieInfo = cookie(static::COOKEY_NAME);
            $cookieArr = $cookieInfo->getValue();
            $userInfo = Auth::user();
            if ($cookieArr) {
                if (isset($cookieArr[1]) && $cookieArr[1] == $userInfo->id) {
                    $ret = $cookieArr[0];
                } else {
                    $ret = 0;
                }
            } else
                $ret = 0;
        }
        return $ret;
    }

    public static function getProject()
    {
        if (!static::$project) {
            static::$project = static::check(static::getProjectId());
        }
        return static::$project;
    }

    public static function check($projectId)
    {
        $projectInfo = null;
        $projectId = (int)$projectId;
        if ($projectId)
            $projectInfo = Project::find($projectId);
        return $projectInfo;
    }

}
