<?php
namespace app\admin\validate;

use think\Validate;

//登录验证器类
class Login extends Validate
{

    protected $rule = [
        'username'  =>  'require|checkName',
        'password' =>  'require|checkPassword',
    ];
    protected $message = [
        'username.require'  =>  '请输入用户名',
        'username.checkName'  =>  '用户名不正确',
        'password.require' =>  '请输入密码',
        'password.checkPassword' =>  '密码不正确',
    ];

    //验证用户名是否正确
    protected function checkName($value,$data)
    {
        //查找数据
        $data=db('Admin')->where('username',$value)->find();

        return $data['username'] == $value ? true : '用户名不正确';
    }

    protected function checkPassword($value,$data)
    {
        //查找数据
        $data=db('Admin')->where('password',md5($value))->find();
        return $data['password'] == md5($value) ? true : '密码不正确';
    }
}