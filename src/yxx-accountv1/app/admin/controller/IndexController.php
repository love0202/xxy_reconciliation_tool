<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\common\Controller;
use app\common\YxxExcel;
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
//        dd('数据转化操作');
        $filePath = 'C:\Users\qpzmv\work\work_xiangwei\yxx\doc\需求\2023年账单\1月账单\韵达淘咖12月.xls';
        // 获取 excel 数据
        $excelModel = new YxxExcel();
        $colArr = ['N'];
        $excelModel->setColArr($colArr);
        $ret = $excelModel->read($filePath, false, true);
        $data = [];
        foreach ($ret as $key => $value) {
            $temp = $value[0];
            $temp = str_replace('=','',$temp);
            $temp = str_replace('"','',$temp);
            $data[] = ['ni'=>$temp];
        }

        // 导出excel
        $headerArr = [
            'ni' => '转化数据',
        ];
        $fileName = '数据转化';
        $excelModel->setHeaderArr($headerArr);
        $excelModel->export($data, $fileName);

    }
}
