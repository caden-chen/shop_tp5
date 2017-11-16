<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Users extends Migrator
{
    /**
     * Change Method.
     */
    public function change()
    {
        // create the table
        $table = $this->table('users',array('engine'=>'MyISAM'));
        $table->addTimestamps();
        $table->setId('user_id')->setPrimaryKey('user_id')
            ->addColumn('user_name', 'string',array('limit' => 15,'default'=>'','comment'=>'用户名称'))
            ->addColumn('user_passwd', 'string',array('default'=>'','comment'=>'用户密码'))
            ->addColumn('user_phone', 'integer',array('limit' => 20,'default'=>0,'comment'=>'用户手机联系方式'))
            ->addColumn('user_email', 'string',array('default'=>'','comment'=>'用户邮箱联系方式'))
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
