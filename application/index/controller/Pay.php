<?php
namespace app\index\controller;

class Pay extends Common
{

    //登录验证
    public function __construct()
    {

        if(!session('?username')){
            $this->redirect(url('index/login/index'));
        }

        if(!session('?cart')){
            $this->redirect(url('index/index/index'));
        }
    }

    //页面
    public function index()
    {
        $cartData=session('cart');
        $uid = db('users')->where('user_email', session('username'))->value('user_id');
        $addressData=db('address')->where('uid',$uid)->select();
        $defaultAddressData=db('address')->where('default',1)->find();
        return $this->make('pay',compact('cartData','addressData','defaultAddressData'));
    }

    //选中状态
    public function select(){
        $aid=input('post.aid');
        //halt($post);
        db('address')->where('address_id',$aid)->update(['default'=>1]);
        db('address')->whereNotIn('address_id',$aid)->update(['default'=>0]);

        $payAddressData=db('address')->find($aid);
        return $payAddressData;
    }

}
