<?php

namespace app\common;

use PHPExcel;

class YxxExcel
{
    public $excelRowNum = 0;
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
     * 设置导入数量
     * @param int $excelRowNum
     */
    public function setExcelRowNum(int $excelRowNum): void
    {
        $this->excelRowNum = $excelRowNum;
    }

    /**
     * 读取excel格式文件的数据
     *
     * @param $fileName
     * @param bool $isHeard
     * @param bool $isPath
     * @return array
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function readTitle($fileName)
    {
        // 或者设置为0表示无限制执行时长
        set_time_limit(0);
        $data     = [];
        $basePath = config('filesystem.disks.public.root');
        $filePath = $basePath . "/" . $fileName;
        if (!is_file($filePath)) {
            dd('文件不存在' . $filePath);
        }
        $suffixArr = explode('.', $fileName);
        $suffix    = end($suffixArr);
        $suffix    = strtoupper($suffix);
        if ($suffix == 'XLSX' || $suffix == 'XLS') {
            header("content-type:text/html;charset=utf-8");
            if ($suffix == 'XLSX') {
                $reader = \PHPExcel_IOFactory::createReader('Excel2007');
            } else {
                $reader = \PHPExcel_IOFactory::createReader('Excel5');
            }
            //载入excel文件
            $excel = $reader->load($filePath, $encode = 'utf-8');
            //读取第一张表
            $sheet = $excel->getSheet(0);

            //获取总行数
            $row = 1;
            //获取总列数
            $highestColumn = $sheet->getHighestColumn(); // 获取最高列号，例如 'Z'
            $col_num       = \PHPExcel_Cell::columnIndexFromString($highestColumn); // 转换为数字索引

            $temp = [];
            for ($col = 1; $col <= $col_num; $col++) {
                $cell = $sheet->getCellByColumnAndRow($col, $row)->getValue();
                if ($cell instanceof \PHPExcel_RichText) {
                    $cell = $cell->__toString();
                }
                $columnLetter        = \PHPExcel_Cell::stringFromColumnIndex($col-1);
                $temp[$columnLetter] = $columnLetter . '-' . $cell;
            }
            $data = $temp;
        }
        return $data;
    }

    /**
     * 读取excel格式文件的数据
     *
     * @param $fileName
     * @param bool $isHeard
     * @param bool $isPath
     * @return array
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function read($fileName, $isHeard = false, $isPath = false)
    {
        // 或者设置为0表示无限制执行时长
        set_time_limit(0);
        $data = [];
        if ($isPath) {
            $filePath = $fileName;
        } else {
            $basePath = config('filesystem.disks.public.root');
            $filePath = $basePath . "/" . $fileName;
        }
        if (!is_file($filePath)) {
            dd('文件不存在' . $filePath);
        }
        $suffixArr = explode('.', $fileName);
        $suffix    = end($suffixArr);
        $suffix    = strtoupper($suffix);
        if ($suffix == 'XLSX' || $suffix == 'XLS') {
            header("content-type:text/html;charset=utf-8");
            if ($suffix == 'XLSX') {
                $reader = \PHPExcel_IOFactory::createReader('Excel2007');
            } else {
                $reader = \PHPExcel_IOFactory::createReader('Excel5');
            }
            //载入excel文件
            $excel = $reader->load($filePath, $encode = 'utf-8');
            //读取第一张表
            $sheet = $excel->getSheet(0);

            //获取总行数
            if (!empty($this->excelRowNum)) {
                $row_num = $this->excelRowNum;
            } else {
                $row_num = $sheet->getHighestRow();
            }
            //获取总列数
            $colArr = $this->colArr;

            $startNum = $isHeard ? 1 : 2;

            for ($i = $startNum; $i <= $row_num; $i++) {
                $temp = [];
                foreach ($colArr as $v) {
                    $cell = $sheet->getCell($v . $i)->getValue();
                    if ($cell instanceof \PHPExcel_RichText) {
                        $cell = $cell->__toString();
                    }
                    $temp[] = $cell;
                }
                $data[$i] = $temp;
            }
        }
        return $data;
    }

    /**
     * 导出excel文件
     *
     * @param array $data
     * @param string $fileName
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function export(array $data, $fileName = 'export_file_name')
    {
        $capitalArr           = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        $LongNumberCapitalArr = ['A'];
        $headerArr            = $this->headerArr;
        $headerNewArr         = array_values($headerArr);
        $headerKeyArr         = array_keys($headerArr);
        $objExcel             = new PHPExcel();
        $objWriter            = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
        $objActSheet          = $objExcel->getActiveSheet(0);
        $objActSheet->setTitle($fileName); //设置excel的标题
        $objActSheet->getStyle('A')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        foreach ($headerNewArr as $key => $value) {
            $cellKey = $capitalArr[$key] . '1';
            $objActSheet->setCellValue($cellKey, $value);
        }

        $baseRow = 2; //数据从N-1行开始往下输出 这里是避免头信息被覆盖 //默认数据
        foreach ($data as $key => $value) {
            $i = $baseRow + $key;
            foreach ($headerKeyArr as $k => $v) {
                $cellKey = $capitalArr[$k] . $i;
                if (in_array($capitalArr[$k], $LongNumberCapitalArr)) {
                    $objActSheet->setCellValueExplicit($cellKey, $value[$v], \PHPExcel_Cell_DataType::TYPE_STRING);
                } else {
                    $objActSheet->setCellValue($cellKey, $value[$v]);
                }
            }
        }


        $objExcel->setActiveSheetIndex(0); //4、输出 $objExcel->setActiveSheetIndex();
        header('Content-Type: applicationnd.ms-excel');
        header("Content-Disposition: attachment;filename=" . $fileName . ".xlsx");
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
}