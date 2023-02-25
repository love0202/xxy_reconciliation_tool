<?php
declare (strict_types=1);

namespace app\index\controller;

use app\common\Controller;
use think\facade\Db;

class IndexController extends Controller
{
    public function index()
    {
        $params = [];

        return view('index/index', $params);
    }

    public function delete()
    {
        $basePath = config('filesystem.disks.public.root');
        if (is_dir($basePath)) {
            delDirAndFile($basePath, true);
        }

        $count = Db::name('express_file')->where(['status' => 0])->count();
        if ($count > 0) {
            return '快递对账单未导出不能删除';
        }

        $tableArr = ['yxx_migrations', 'yxx_weight_file', 'yxx_weight_shop'];
        // 启动事务
        Db::startTrans();
        try {
            $tables = Db::getTables();
            foreach ($tables as $key => $v) {
                if (in_array($v, $tableArr)) {
                    continue;
                }
                $sql = "TRUNCATE `" . $v . "`;";
                Db::query($sql);
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            dd($e->getMessage());
        }
        return view('index/index');
    }

    /**
     * 刷库操作
     */
    public function test()
    {

    }
}
