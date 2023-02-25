<?php

use think\migration\Migrator;
use think\migration\db\Column;

class TaobaoOrder extends Migrator
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
        $table = $this->table('taobao_order');
        $table->addColumn('taobao_file_id', 'integer', array('limit' => 10, 'default' => 0, 'comment' => 'taobao_file表ID'))
            ->addColumn('order_number', 'string', array('limit' => 50, 'default' => '', 'comment' => '订单号'))
            ->addColumn('order_express_number', 'string', array('limit' => 50, 'default' => '', 'comment' => '物流单号'))
            ->addColumn('express_company', 'string', array('limit' => 50, 'default' => '', 'comment' => '物流公司'))
            ->addColumn('member', 'string', array('limit' => 50, 'default' => '', 'comment' => '买家会员名'))
            ->addColumn('dataJSON', 'text', array('null' => true, 'comment' => 'excel的内容'))
            ->addIndex(array('order_number','order_express_number'))
            ->create();
    }
}
