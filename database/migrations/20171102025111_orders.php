<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Orders extends Migrator
{
    /**
     * Change Method.
     */
    public function change()
    {
        // create the table
        $table = $this->table('orders',array('engine'=>'MyISAM'));
        $table->addTimestamps();
        $table->setId('orders_id')->setPrimaryKey('orders_id')
            ->addColumn('orders_name', 'string',array('limit' => 15,'default'=>'','comment'=>'订单名称'))
            ->addColumn('orders_number', 'string',array('default'=>'','comment'=>'订单号'))
            ->addColumn('orders_time', 'string',array('default'=>'','comment'=>'订单生成时间'))
            ->addColumn('total_price', 'string',array('default'=>'','comment'=>'订单价格'))
            ->addColumn('orders_num', 'string',array('default'=>'','comment'=>'订单数量'))
            ->addColumn('uid', 'string',array('default'=>'','comment'=>'下订单的用户'))
            ->addColumn('orders_list', 'string',array('default'=>'','comment'=>'订单详细列表'))
            ->create();
    }

    /**
     * Migrate Up.
     */
    public function up()
    {

    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
