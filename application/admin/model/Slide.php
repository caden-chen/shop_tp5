<?php

namespace app\admin\model;

use think\Model;

class Slide extends Model
{
    protected $pk='slide_id';
    protected $table='slide';
    //添加
    public function add($data){
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->validate(true)->save($data);
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'操作成功'];
        }
    }

    public function change($data,$id){
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->validate(true)->save($data,['slide_id'=>$id]);
        //dd($result);die;
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'操作成功'];
        }
    }

}
