<?php
namespace app\index\model;

use think\Model;

class Register extends Model
{
    protected $table='users';
    protected $pk='user_id';

    public function register($data){
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->allowField(true)->validate('Register')->save($data);
        //dd($result);die;
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'注册成功'];
        }
    }



}