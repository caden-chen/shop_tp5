<?php
namespace app\index\controller;



use think\Session;

class Cart extends Common
{



    public function index()
    {
        //halt(Session::get());
        $cartData=session('cart');
        //halt($cartData);
        return $this->make('shopcart',compact('cartData'));
    }


    public function Auth()
    {
//        halt(session('?username'));
        if(session('?username')){
            return ['code'=>1,'msg'=>''];
        }else{
            return ['code'=>0,'msg'=>'您好,请先登录!'];
        }
    }
    /**
     * 异步更新购物车
     */
    public function UpdateCart(){
        //echo 11;
        $post = input ('post.');
        //halt($post);
        $data=array(
            'sid'=>$post['sid'],// 唯一 sid，添加购物车时自动生成
            'num'=>$post['num']
        );
        (new \component\Cart())->update($data);
        $field=session('cart');
        return $field;
    }

    public function del(){
        $post = input ('post.');
        //halt($post);
        $data=array(
            'sid'=>$post['sid'],// 唯一 sid，添加购物车时自动生成
            'num'=>$post['num']
        );
        (new \component\Cart())->update($data);
        $field=session('cart');
        return ['code'=>1,'msg'=>'删除成功','data'=>$field];

    }

    public function deleteAll(){
        (new \component\Cart())->flush();
        return ['code'=>1,'msg'=>'删除成功'];
    }

}
