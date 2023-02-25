<?php

namespace app\merchant\model;

use app\merchant\model\merchant\Taobao;
use app\merchant\model\merchant\Tianmao;
use app\merchant\model\merchant\Pdd;
use app\common\YxxConfig;
use think\facade\Db;

class Merchant
{
    public $type;
    public $path = 'merchant_file';
    public $model;

    public function setModel()
    {
        $model = '';
        $merchantTypeList = YxxConfig::list('MERCHANT_TYPE');
        if (!isset($merchantTypeList[$this->type])) {
            return false;
        }
        switch ($this->type) {
            case YxxConfig::value('MERCHANT_TYPE', 'T1'):
                $this->model = new Taobao();
                break;
            case YxxConfig::value('MERCHANT_TYPE', 'T2'):
                $this->model = new Tianmao();
                break;
            case YxxConfig::value('MERCHANT_TYPE', 'T3'):
                $this->model = new Pdd();
                break;
            default:
                break;
        }
        return $this->model;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setPath($path = '')
    {
        if (!empty($path)) {
            $this->path = $path;
        } else {
            if (!empty($this->type)) {
                $this->path = 'merchant_file/' . YxxConfig::name('MERCHANT_TYPE', $this->type);
            }
        }
    }

    public function check($params = [])
    {
        if (!isset($params['type'])) {
            dd('商户数据源类别不能为空');
        }
        $this->setType($params['type']);
        $this->setPath();
        $this->setModel();
        $fromFile = $this->model->getFromFile();
        foreach ($fromFile as $key => $value) {
            if (!isset($params[$key]) && empty($params[$key])) {
                dd($value['fromName'] . '上传文件都不能为空');
            }
        }
    }

    public function save($params = [])
    {
        $fileArray = $this->putFromFile($params);

        $insertData = [];
        $insertData['name'] = $params['name'];
        $insertData['type'] = $params['type'];
        $insertData['fileJSON'] = json_encode($fileArray);
        $insertData['status'] = 0;
        $insertData['create_time'] = time();

        $ret = Db::name('merchant_file')->insert($insertData);
        if (!$ret) {
            return false;
        }
        return true;
    }

    /**
     * 上传文件
     *
     * @param array $params
     * @return array
     */
    public function putFromFile($params = [])
    {
        $fromFile = $this->model->getFromFile();
        $path = $this->path;
        foreach ($fromFile as $key => $value) {
            $fromFile[$key]['name'] = $params[$key]->getOriginalName();
            $fromFile[$key]['path'] = \think\facade\Filesystem::disk('public')->putFile($path, $params[$key], 'uniqid');
        }
        return $fromFile;
    }

    public function list($params = [])
    {
        $array = [];
        $query = Db::name('merchant_file');
        $list = $query->order('id', 'asc')->paginate([
            'query' => [],
            'list_rows' => 15,
        ]);
        $ret = $list->toArray();
        foreach ($ret['data'] as $key => $value) {
            $temp = [];
            $fileArr = json_decode($value['fileJSON'],true);
            $temp['id'] = $value['id'];
            $temp['name'] = $value['name'];
            $temp['type'] = YxxConfig::name('MERCHANT_TYPE', $value['type']);
            $temp['fileArr'] = $fileArr;
            $temp['status'] = $value['status'];
            $temp['create_time'] = $value['create_time'];
            $ret['data'][$key] = $temp;
        }

        $array['list'] = $ret;
        $array['page'] = $list->render();
        return $array;
    }
}