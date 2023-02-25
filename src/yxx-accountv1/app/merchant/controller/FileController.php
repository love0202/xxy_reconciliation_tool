<?php
declare (strict_types=1);

namespace app\merchant\controller;

use app\common\BaseController;
use app\common\YxxConfig;
use app\merchant\model\Merchant;
use think\facade\Db;
use think\Request;

class FileController extends BaseController
{
    public function list()
    {
        $params = [];

        $merchantModel = new Merchant();
        $ret = $merchantModel->list($params);

        $params['list'] = $ret['list'];
        $params['page'] = $ret['page'];
        return view('list', $params);
    }

    public function create(Request $request)
    {
        $type = $request->get('type', YxxConfig::value('MERCHANT_TYPE', 'T1'));
        $params = [];

        $merchantModel = new Merchant();
        $merchantModel->setType($type);
        $model = $merchantModel->setModel();
        $fromFile = $model->getFromFile();

        $merchantTypeList = YxxConfig::list('MERCHANT_TYPE');
        $params['merchantTypeList'] = $merchantTypeList;
        $params['type'] = $type;
        $params['fromFile'] = $fromFile;

        return view('create', $params);
    }

    /**
     * 保存新建的资源
     *
     */
    public function save(Request $request)
    {
        $params = $request->all();

        $merchantModel = new Merchant();
        $merchantModel->check($params);

        $merchantModel->save($params);
        return redirect((string)url('merchant/file/list'));
    }

    /**
     * ajax 导入
     *
     */
    public function ajaxImport(Request $request)
    {
        $fileId = \request()->param('id');
        $fileInfo = Db::name('merchant_file')->where(['id' => $fileId, 'status' => 0])->find();

        if (empty($fileInfo)) {
            echo json_encode(['success' => 0, 'message' => '数据不存在']);
            die();
        }
    }
}
