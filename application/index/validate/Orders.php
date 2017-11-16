<?php
namespace app\index\validate;

use think\Validate;

//登录验证器类
class Orders extends Validate
{

    protected $rule = [
        'oname'=>'require',
        'ogoods' =>  'require',
        'oaddress' =>  'require|checkNull',
    ];
    protected $message = [
        'oname.require'  =>  '请输入订单号',
        'ogoods.require'  =>  '请输入收件人联系电话',
        'oaddress.require'  =>  '请选择收件人详细地址',
    ];

    protected function checkNull($value,$data)
    {
        //dd($value);die;
        //查找数据
        return  $value == 'null' ? '请选择收件人详细地址' :true ;
    }
}