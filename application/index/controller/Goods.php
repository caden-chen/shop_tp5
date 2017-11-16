<?php

namespace app\index\controller;

use think\Db;

class Goods extends Common
{
    public function index()
    {
        //获取当前gid号元素
        $gid = input('param.gid');
        $field = Db::table('goods')->find($gid);
        //halt($field);
        $field['pics'] = explode(',', $field['pics']);
        //获取当前商品数据
        $spec = db('spec')->where('gid', $gid)->select();
        //dd($field);die;


        //推荐相似数据
        $reData = Db::query("SELECT * FROM goods WHERE goods_id != {$gid} ORDER BY RAND() LIMIT 5");
        $likeData = Db::query("SELECT * FROM goods WHERE goods_id != {$gid} ORDER BY RAND()");


        $TagData = Db::table('tags')->select();
        //递归找父级数据
        $fatherData = (new Lists())->getFather($TagData, $field['tid']);
        $fatherData = array_reverse($fatherData);
        //halt($fatherData);

        return $this->make('introduction', compact('field', 'spec', 'reData', 'likeData', 'fatherData'));
    }

    public function AddCart()
    {
        $post=input('post.');
        //dd($post);die;

        //根据商品id获取当前商品数据
        $goods=db('goods')->find($post['gid']);
        $data = [
            'id' => $post['gid'], // 商品 ID
            'name' => $goods['goods_name'].$goods['goods_desc'],// 商品名称
            'num' => $post['num'], // 商品数量
            'price' => $goods['price'], // 商品价格
            'options' => [
                'spec'=>$post['spec'],
                'img'=>$goods['list_img']
            ]// 其他参数如价格、颜色、可以为数组或字符串

        ];
        (new \component\Cart())->add($data); // 添加到购物车
        return $this->success('操作成功',url('/index/index/index'));
    }
}
