<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Goods extends Migrator
{
    /**
     * Change Method.
     */
    public function change()
    {
        // create the table
        $table = $this->table('goods',array('engine'=>'MyISAM'));
        $table->addTimestamps();
        $table->setId('goods_id')->setPrimaryKey('goods_id')
            ->addColumn('goods_name', 'string',array('limit' => 100,'default'=>'','comment'=>'商品名称'))
            ->addColumn('price', 'integer',array('default'=>0,'comment'=>'商品价格'))
            ->addColumn('tid', 'string',array('default'=>'','comment'=>'所属类别'))
            ->addColumn('is_hot', 'integer',array('default'=>2,'comment'=>'是否热门 1是 2否'))
            ->addColumn('is_recommend', 'integer',array('default'=>2,'comment'=>'是否推荐 1是 2否'))
            ->addColumn('attr_img', 'string',array('default'=>'','comment'=>'详情图片'))
            ->addColumn('list_img', 'string',array('limit' => 1000,'default'=>'','comment'=>'商品封面图'))
            ->addColumn('details', 'text',array('comment'=>'商品详情'))
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
