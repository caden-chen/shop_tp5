<?php

namespace app\index\controller;

use app\index\model\Olist;
use app\index\model\Orders as OrdersModel;
class Orders extends Common
{

    public function __construct()
    {
        if (!session('?username')) {
            $this->redirect('/index/login/index');
        }
    }

    public function index()
    {
        $oid=input('param.oid');
        $orderData=db('orders')->find($oid);
        $orderData['ogoods']=json_decode($orderData['ogoods'],true);
        $orderData['oaddress']=json_decode($orderData['oaddress'],true);
        //halt($orderData['ogoods']);
        return $this->make('orderinfo',compact('orderData'));
    }

    /**
     * 添加到订单表
     * @param OrdersModel $orders
     */
    public function store(OrdersModel $orders)
    {
        if (request()->post()) {

            $aid = input('post.aid');
            $proposal=input('post.proposal');
            $addrData=db('address')->find($aid);
            $goodsData=session('cart');
            $goodsData['proposal']=$proposal;
            $oname=(new \component\Cart())->getOrderId();
            $data = [
                'oname' => $oname,
                'ogoods' => json_encode($goodsData),
                'oaddress' => json_encode($addrData),
                'time'=>time(),
            ];
            //dd($data);die;
            $res = $orders->adds($data);
            //dd($res);die;
            if ($res['code']==1) {
                $oid=$res['oid'];
                $uid = db('users')->where('user_email', session('username'))->value('user_id');

                $listData=[
                    'oid'=>$oid,
                    'uid'=>$uid
                ];
                //添加到订单列表
                (new Olist())->adds($listData);
                session('cart', null);
                $this->success($res['msg'], "/s/{$oid}/{$aid}.html");
            } else {
                $this->error($res['msg']);
            }
        }
    }

}
