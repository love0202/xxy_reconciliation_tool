<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ExpressShentong extends Migrator
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
        $table = $this->table('express_shentong');
        $table->addColumn('express_file_id', 'integer', array('limit' => 10, 'default' => 0, 'comment' => 'express_file表ID'))
            ->addColumn('order_number', 'string', array('limit' => 50, 'default' => '', 'comment' => '订单号'))
            ->addColumn('member', 'string', array('limit' => 1000, 'default' => '', 'comment' => '买家会员名'))
            ->addColumn('shopinfo', 'string', array('limit' => 3000, 'default' => '', 'comment' => '商品详情'))
            ->addColumn('express_weight', 'string', array('limit' => 100, 'default' => '', 'comment' => '快递重量'))
            ->addColumn('weight', 'string', array('limit' => 100, 'default' => '', 'comment' => '重量'))
            ->addColumn('dataJSON', 'text', array('null' => true, 'comment' => 'excel的内容'))
            ->addIndex(array('order_number'))
            ->addIndex(array('shopinfo'))
            ->create();
    }
}
