<?php
namespace app\admin\validate;

use think\Validate;

//登录验证器类
class Admin extends Validate
{

    protected $rule = [
        'username'  =>  'require|checkName',
        'password' =>  'require|checkPassword',
        'new_password'=>'require',
        'confirm_password'=>'require|confirm:new_password'
    ];
    protected $message = [
        'username.require'  =>  '请输入用户名',
        'username.checkName'  =>  '用户名不正确',
        'password.require' =>  '请输入密码',
        'password.checkPassword' =>  '密码不正确',
        'new_password.require' =>  '请输入新密码',
        'confirm_password.require' =>  '请输入确认密码',
        'confirm_password.confirm' =>  '两次密码不一致',
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