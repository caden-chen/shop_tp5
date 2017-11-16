<?php
namespace app\admin\validate;

use think\Validate;

//登录验证器类
class Goods extends Validate
{

    protected $rule = [
        'goods_name'  =>  'require',
        'price' =>  'require|number',
        'click' =>  'require|number',
    ];
    protected $message = [
        'goods_name.require'  =>  '请输入商品名称',
        'price.require' =>  '请输入价格',
        'price.number' =>  '排序必须为数字',
        'click.require' =>  '请输入点击次数',
        'click.number' =>  '点击次数必须为数字',
    ];
}