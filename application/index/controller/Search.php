<?php
namespace app\index\controller;

use think\Db;

class Search extends Common
{
    public function index()
    {
        $search=input('post.index_none_header_sysc');
        $searchData=Db::table('goods')
            ->where('goods_name','like','%'.$search.'%')
            ->select();
        //dd($searchData);die;
        //获取随机推荐商品信息
        $randData=Db::query("SELECT * FROM goods ORDER BY RAND() LIMIT 3");
        //dd($randData);die;
        return $this->make('search',compact('randData','searchData','search'));
    }

}
