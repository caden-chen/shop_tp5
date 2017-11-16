<?php
namespace app\index\controller;

use think\Request;

class Success extends Common
{

    public function __construct()
    {
        if(!session('?username')){
            $this->redirect('/index/login/index');
        }
    }

    public function index(Request $request)
    {
        $aid=input('param.aid');
        $oid=input('param.oid');
        $addrData=db('address')->find($aid);
        $money=session('cart.total_price');
        return $this->make('success',compact('addrData','money','oid'));
    }
}
