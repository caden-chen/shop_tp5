<?php
namespace app\admin\validate;

use think\Validate;

//登录验证器类
class Slide extends Validate
{

    protected $rule = [
        'slide_name'  =>  'require',
        'slide_sort' =>  'require|number',
        'slide_url' =>  'require',
        'preview' =>  'require',
    ];
    protected $message = [
        'slide_name.require'  =>  '请输入轮播图标题',
        'slide_sort.require' =>  '请输入排序',
        'slide_sort.number' =>  '排序必须为数字',
        'slide_url.require' =>  '请输入链接地址',
        'preview.require' =>  '请上传图片',
    ];
}