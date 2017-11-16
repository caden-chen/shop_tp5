<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Tags extends Migrator
{
    /**
     * Change Method.
     */
    public function change()
    {
        // create the table
        $table = $this->table('tags',array('engine'=>'MyISAM'));
        $table->addTimestamps();
        $table->setId('tag_id')->setPrimaryKey('tag_id')
            ->addColumn('tag_name', 'string',array('limit' => 15,'default'=>'','comment'=>'标签名称'))
            ->addColumn('pid', 'string',array('default'=>'','comment'=>'所属的父标签'))
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
