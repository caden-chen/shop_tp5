<?php
namespace app\index\model;

use think\Model;

class Orders extends Model
{
    protected $table='orders';
    protected $pk='oid';

    public function adds($data){
//        halt($data);die;
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->validate()->allowField(true)->save($data);
        //dd($result);die;
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'支付成功','oid'=>$this->oid];
        }
    }

    public function edit($data,$aid){
        //halt($aid);
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->allowField(true)->validate('Orders')->save($data,['orders_id'=>$aid]);
        //dd($result);die;
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'编辑成功'];
        }
    }



}