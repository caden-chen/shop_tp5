<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Address extends Migrator
{
    /**
     * Change Method.
     */
    public function change()
    {
        // create the table
        $table = $this->table('address',array('engine'=>'MyISAM'));
        $table->addTimestamps();
        $table->setId('address_id')->setPrimaryKey('address_id')
            ->addColumn('username', 'string',array('limit' => 15,'default'=>'','comment'=>'收货姓名'))
            ->addColumn('tel', 'string',array('default'=>'','comment'=>'手机联系方式'))
            ->addColumn('email', 'string',array('default'=>'','comment'=>'邮箱'))
            ->addColumn('location', 'string',array('default'=>'','comment'=>'收获地址'))
            ->addColumn('uid', 'string',array('default'=>'','comment'=>'下单用户'))
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
