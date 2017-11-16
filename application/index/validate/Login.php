<?php
namespace app\index\validate;

use think\Validate;

//登录验证器类
class Login extends Validate
{

    protected $rule = [
        'user_email'=>'require|email|checkName',
        'user_passwd' =>  'require|checkPassword',
    ];
    protected $message = [
        'user_email.require'  =>  '请输入邮箱地址',
        'user_email.email'  =>  '请输入正确的邮箱地址',
    ];
    
    //验证用户名是否正确
    protected function checkName($value,$data)
    {
        //dd($value);die;
        //查找数据
        $data=db('Users')->where('user_email',$value)->find();

        return $data['user_email'] == $value ? true : '邮箱不存在';
    }

    //验证用户名是否存在
    protected function onceName($value,$data)
    {
        //查找数据
        $data=db('users')->where('user_email',$value)->find();

        return $data['user_email'] == $value ? '用户名已存在' : true;
    }

    protected function checkPassword($value,$data)
    {
        //查找数据
        $data=db('Users')->where('user_passwd',md5($value))->find();
        return $data['user_passwd'] == md5($value) ? true : '密码不正确';
    }
}