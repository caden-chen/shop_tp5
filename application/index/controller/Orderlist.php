<?php
namespace app\index\controller;

use think\Request;

class Orderlist extends Common
{
    public function __construct(Request $request = null)
    {
        if(!session('?username')){
            $this->redirect('/index/login/index');
        }
    }

    public function index()
    {


        $orderData = db('orders_list')
            ->alias('ol')
            ->join('orders o', 'ol.oid = o.oid')
            ->join('users u', 'ol.uid = u.user_id')
            ->order('time desc')
            ->where('user_email',session('username'))
            ->select();
        foreach ($orderData as $k => $v) {
            $orderData[$k]['ogoods'] = json_decode($v['ogoods'], true);
            $orderData[$k]['oaddress'] = json_decode($v['oaddress'], true);
        }

        //halt($orderData);
        $map['user_email']  = session('username');
        $map['state']  = 0;
        $orderData2 = db('orders_list')
            ->alias('ol')
            ->join('orders o', 'ol.oid = o.oid')
            ->join('users u', 'ol.uid = u.user_id')
            ->order('time desc')
            ->where($map)
            ->select();
        foreach ($orderData2 as $k => $v) {
            $orderData2[$k]['ogoods'] = json_decode($v['ogoods'], true);
            $orderData2[$k]['oaddress'] = json_decode($v['oaddress'], true);
        }

        $map['user_email']  = session('username');
        $map['state']  = 1;
        $orderData3 = db('orders_list')
            ->alias('ol')
            ->join('orders o', 'ol.oid = o.oid')
            ->join('users u', 'ol.uid = u.user_id')
            ->order('time desc')
            ->where($map)
            ->select();
        foreach ($orderData3 as $k => $v) {
            $orderData3[$k]['ogoods'] = json_decode($v['ogoods'], true);
            $orderData3[$k]['oaddress'] = json_decode($v['oaddress'], true);
        }

        $map['user_email']  = session('username');
        $map['state']  = 2;
        $orderData4 = db('orders_list')
            ->alias('ol')
            ->join('orders o', 'ol.oid = o.oid')
            ->join('users u', 'ol.uid = u.user_id')
            ->order('time desc')
            ->where($map)
            ->select();
        foreach ($orderData4 as $k => $v) {
            $orderData4[$k]['ogoods'] = json_decode($v['ogoods'], true);
            $orderData4[$k]['oaddress'] = json_decode($v['oaddress'], true);
        }

        $map['user_email']  = session('username');
        $map['state']  = 3;
        $orderData5 = db('orders_list')
            ->alias('ol')
            ->join('orders o', 'ol.oid = o.oid')
            ->join('users u', 'ol.uid = u.user_id')
            ->order('time desc')
            ->where($map)
            ->select();
        foreach ($orderData5 as $k => $v) {
            $orderData5[$k]['ogoods'] = json_decode($v['ogoods'],true);
            $orderData5[$k]['oaddress'] = json_decode($v['oaddress'], true);
        }

        //halt($orderData);
        return $this->make('order',compact('orderData','orderData2','orderData3','orderData4','orderData5'));
    }





    //取消订单
    public function cancel()
    {
        $oid=input('post.oid');
        $state=db('orders')->where('oid',$oid)->value('state');
        if ($state==4){
            return ['msg'=>'订单取消','operation'=>'删除订单'];
        }else{
            db('orders')->where('oid',$oid)->setField('state',5);
            return ['msg'=>'等待审核','operation'=>'等待审核'];
        }
    }


    //确认收货
    public function confirm()
    {
        $oid=input('post.oid');
        db('orders')->where('oid',$oid)->setField('state',3);
        return ['msg'=>'交易完成','operation'=>'删除订单'];
    }

    //付款
    public function pay()
    {
        $oid=input('post.oid');
        db('orders')->where('oid',$oid)->setField('state',1);
        return ['msg'=>'待发货','operation'=>'确认收货'];
    }

    //删除订单
    public function del()
    {
        $oid=input('post.oid');
        db('orders')->delete($oid);
        db('orders_list')->where('oid',$oid)->delete();
        return ['msg'=>'删除成功'];
    }
}