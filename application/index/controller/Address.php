<?php

namespace app\index\controller;

use app\index\model\Address as AddressModel;

class Address extends Common
{
    public function __construct()
    {
        if(!session('?username')){
            $this->redirect('/index/login/index');
        }
    }

    public function index(AddressModel $address)
    {
        $uid = db('users')->where('user_email', session('username'))->value('user_id');
        $AddressData=db('address')->where('uid',$uid)->select();
        return $this->make('address',compact('AddressData'));
    }

    public function add(AddressModel $address){
        //halt(Session::get());
        if (request()->post()) {
             //halt($_POST);
            $post = input('post.');
            $uid = db('users')->where('user_email', session('username'))->value('user_id');
            $data = [
                'aname' => $post['aname'],
                'tel' => $post['tel'],
                'location' => $post['location'],
                'city' =>$post['city'],
                'uid' => $uid,
            ];
            //halt($post['aid']);
            if ($post['aid']==""){
                $res = $address->adds($data);
                if ($res['code']) {
                    $this->success($res['msg'], url('index/index/index'));
                } else {
                    $this->error($res['msg']);
                }
            }else{
                $res = $address->edit($data,$post['aid']);
                if ($res['code']) {
                    $this->success($res['msg'], url('index/index/index'));
                } else {
                    $this->error($res['msg']);
                }
            }
        }
    }

    public function edit(){
        $aid=input('post.aid');
        $addData=db('address')->where('address_id',$aid)->select();
        return $addData['0'];
    }

    public function del()
    {
        $aid=input('post.');
        $res=db('address')->delete($aid);
        if ($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        }
    }
}