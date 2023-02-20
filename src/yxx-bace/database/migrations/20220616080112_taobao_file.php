<?php

use think\migration\Migrator;
use think\migration\db\Column;

class TaobaoFile extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('taobao_file');
        $table->addColumn('name', 'string', array('limit' => 30, 'default' => '', 'comment' => '标题'))
            ->addColumn('order_filename', 'string', array('limit' => 200, 'default' => '', 'comment' => '订单文件名'))
            ->addColumn('order_path', 'string', array('limit' => 200, 'default' => '', 'comment' => '订单文件地址'))
            ->addColumn('num_order', 'integer', array('limit' => 10, 'default' => 0, 'comment' => '导入订单行数'))
            ->addColumn('order_shop_filename', 'string', array('limit' => 200, 'default' => '', 'comment' => '订单商品详情文件名'))
            ->addColumn('order_shop_path', 'string', array('limit' => 200, 'default' => '', 'comment' => '订单商品详情文件地址'))
            ->addColumn('num_shop', 'integer', array('limit' => 10, 'default' => 0, 'comment' => '导入订单商品行数'))
            ->addColumn('status', 'boolean',array('limit'  =>  1,'default'=>0,'comment'=>'导入状态，1已导入 0未导入'))
            ->addColumn('create_time', 'integer',array('limit'  =>  11,'default'=>0,'comment'=>'创建时间'))
            ->create();
    }
}
