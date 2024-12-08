<?php

namespace app\common;

class YxxCsv
{
    public $colArr = [];
    public $headerArr = [];

    /**
     * 设置读取栏位
     *
     * @param array $colArr
     */
    public function setColArr(array $colArr)
    {
        $this->colArr = $colArr;
    }

    /**
     * 设置导出栏位
     *
     * @param array $headerArr
     */
    public function setHeaderArr(array $headerArr)
    {
        $this->headerArr = $headerArr;
    }

    /**
     * 读取csv格式文件的数据
     *
     * @param $fileName
     * @param bool $isHeard
     * @return array|mixed
     */
    public function read($fileName, $isHeard = false)
    {
        $data = [];
        $basePath = config('filesystem.disks.public.root');
        $filePath = $basePath . "/" . $fileName;
        if (!is_file($filePath)) {
            dd('文件不存在' . $filePath);
        }
        $suffixArr = explode('.', $fileName);
        $suffix = end($suffixArr);
        $suffix = strtoupper($suffix);
        $colArr = $this->colArr;
        if ($suffix == 'CSV') {
            $handle = fopen($filePath, "rb");
            $data = [];
            while (!feof($handle)) {
                $line = fgetcsv($handle);
                if (isset($line[14])) {
                    $encode = mb_detect_encoding($line[14], array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
                    if ($encode == 'CP936') {
                        $line[14] = '';
                    }
                }
                if (!empty($line)) {
                    $temp = [];
                    foreach ($colArr as $num) {
                        $temp[] = isset($line[$num]) ? $line[$num] : '';
                    }
                    $data[] = $temp;
                }
            }
            fclose($handle);

            $data = eval('return ' . iconv('gbk', 'utf-8', var_export($data, true)) . ';');    //字符转码操作
        }
        if (empty($isHeard) && isset($data[0])) {
            unset($data[0]);
        }

        return $data;
    }

    /**
     * 导出excel文件
     *
     * @param array $data
     * @param string $fileName
     */
    public function export(array $data, $fileName = 'export_file_name')
    {
        //下载csv的文件名
        $fileName = $fileName . '.csv';
        //设置header头
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        //打开php数据输入缓冲区
        $fp = fopen('php://output', 'a');
        $header = $this->headerArr;
        //将数据编码转换成GBK格式
        mb_convert_variables('GBK', 'UTF-8', $header);
        //将数据格式化为CSV格式并写入到output流中
        fputcsv($fp, $header);

        //如果在csv中输出一个空行，向句柄中写入一个空数组即可实现
        foreach ($data as $row) {
            //将数据编码转换成GBK格式
            mb_convert_variables('GBK', 'UTF-8', $row);
            fputcsv($fp, $row);
            //将已经存储到csv中的变量数据销毁，释放内存
            unset($row);
        }
        //关闭句柄
        fclose($fp);
        die;
    }
}