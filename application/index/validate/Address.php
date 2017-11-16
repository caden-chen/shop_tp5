<?php
namespace app\index\validate;

use think\Validate;

//登录验证器类
class Address extends Validate
{

    protected $rule = [
        'aname'=>'require',
        'tel' =>  'require',
        'location' =>  'require',
    ];
    protected $message = [
        'aname.require'  =>  '请输入收件人姓名',
        'tel.require'  =>  '请输入收件人联系电话',
        'location.require'  =>  '请输入收件人详细地址',
    ];
}