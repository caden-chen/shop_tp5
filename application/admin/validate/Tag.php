<?php
namespace app\admin\validate;

use think\Validate;

//登录验证器类
class Tag extends Validate
{

    protected $rule = [
        'tag_name'  =>  'require',
        'pid' =>  'require',
    ];
    protected $message = [
        'tag_name.require'  =>  '请输入栏目名称',
        'pid.require' =>  '请选择栏目',
    ];
}