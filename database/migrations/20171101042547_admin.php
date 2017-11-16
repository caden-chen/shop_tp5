<?php

use Phinx\Migration\AbstractMigration;

class Admin extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change()
    {
        // create the table
        $table = $this->table('admin',array('engine'=>'MyISAM'));
        $table->addTimestamps();
        $table->addColumn('username', 'string',array('limit' => 15,'default'=>'','comment'=>'用户名，登陆使用'))
            ->addColumn('password', 'string',array('limit' => 32,'default'=>md5('admin888'),'comment'=>'用户密码'))
            ->addIndex(array('username'), array('unique' => true))
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