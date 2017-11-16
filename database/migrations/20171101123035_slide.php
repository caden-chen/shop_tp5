<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Slide extends Migrator
{
    /**
     * Change Method.
     */
    public function change()
    {
        // create the table
        $table = $this->table('slide',array('engine'=>'MyISAM'));
        $table->addTimestamps();
        $table->setId('slide_id')->setPrimaryKey('slide_id')
            ->addColumn('slide_name', 'string',array('limit' => 15,'default'=>'','comment'=>'轮播图名称'))
            ->addColumn('slide_sort', 'string',array('default'=>'','comment'=>'轮播图排序'))
            ->addColumn('slide_url', 'string',array('default'=>'','comment'=>'轮播图链接'))
            ->addColumn('preview', 'string',array('default'=>'','comment'=>'轮播图地址'))
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
