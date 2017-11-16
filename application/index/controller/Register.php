<?php
namespace app\index\controller;


use app\index\model\Register as ResModel;

class Register extends Common
{
    public function index(ResModel $register)
    {
        if (request()->post()){
            $data=input('post.');
            //dd($data);die;
            $userData=[
              'check'=>$data['check'],
              'user_email'=>$data['user_email'],
              'user_passwd'=>md5($data['user_passwd']),
              'confirm_user_passwd'=>md5($data['confirm_user_passwd']),

            ];
            $res=$register->register($userData);
            if($res['code']){
                $this->success ($res['msg'],url('index/login/index'));
            }else{
                $this->error ($res['msg']);
            }
        }
        return $this->make('register');
    }


}
