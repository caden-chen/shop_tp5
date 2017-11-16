<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Personal extends Common
{
    public function __construct(Request $request = null)
    {
        if(!session('?username')){

            $this->redirect('/login.html');
        }
    }

    public function index()
    {

        $goodsData=Db::query("SELECT * FROM goods ORDER BY RAND() LIMIT 8");
        $hotData=db('goods')->where('is_hot',1)->limit(1)->find();
        $reData=db('goods')->where('is_recommend',1)->limit(1)->find();

        //halt($goodsData);
        return $this->make('personal',compact('goodsData','hotData','reData'));
    }
}