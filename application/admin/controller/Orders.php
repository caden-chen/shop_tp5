<?php

namespace app\admin\controller;

class Orders extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $orderData = db('orders_list')
            ->alias('ol')
            ->join('orders o', 'ol.oid = o.oid')
            ->join('users u', 'ol.uid = u.user_id')
            ->order('time desc')->select();
        foreach ($orderData as $k => $v) {
            $orderData[$k]['ogoods'] = json_decode($v['ogoods'], true);
            $orderData[$k]['oaddress'] = json_decode($v['oaddress'], true);
            $state = $v['state'];
            switch ($state) {
                case 0:
                    $orderData[$k]['ok'] = '待付款';
                    break;
                case 1:
                    $orderData[$k]['ok'] = '待发货';
                    break;
                case 2:
                    $orderData[$k]['ok'] = '待收货';
                    break;
                case 3:
                    $orderData[$k]['ok'] = '交易完成';
                    break;
                case 4:
                    $orderData[$k]['ok'] = '订单取消';
                    break;
                case 5:
                    $orderData[$k]['ok'] = '等待审核';
                    break;
            }
        }
        //halt($orderData);
        return view('', compact('orderData'));
    }

    public function show(){
        $oid=input('param.oid');
        //halt($oid);
        $orderData=db('orders')->find($oid);
        $orderData['ogoods']=json_decode($orderData['ogoods'],true);
        $orderData['oaddress']=json_decode($orderData['oaddress'],true);
        //halt($orderData);
        return view('',compact('orderData'));
    }

    //发货
    public function setOut()
    {
        $oid=input('post.oid');
        db('orders')->where('oid',$oid)->setField('state',2);
        return ['msg'=>'待收货'];
    }

    //收货
    public function complete()
    {
        $oid=input('post.oid');
        db('orders')->where('oid',$oid)->setField('state',3);
        return ['msg'=>'交易完成'];
    }

    //取消
    public function cancel()
    {
        $oid=input('post.oid');
        db('orders')->where('oid',$oid)->setField('state',4);
        return ['msg'=>'订单取消'];
    }
}
