<?php
namespace app\index\controller;

use think\Session;

class Login extends Common
{
    public function index()
    {
        if (request()->post()){
            $data=input('post.');
            //dd($postData);die;
            $result = $this->validate($data,'Login');
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }else{
                Session::set('username',$data['user_email']);
                $this->success ('登录成功',url('index/index/index'));
            }
        }
        return $this->make('login');
    }


}
