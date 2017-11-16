<?php
namespace app\index\model;

use think\Model;

class Address extends Model
{
    protected $table='address';
    protected $pk='address_id';

    public function adds($data){
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->allowField(true)->validate('Address')->save($data);
        //dd($result);die;
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'添加成功'];
        }
    }

    public function edit($data,$aid){
        //halt($aid);
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->allowField(true)->validate('Address')->save($data,['address_id'=>$aid]);
        //dd($result);die;
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'编辑成功'];
        }
    }



}