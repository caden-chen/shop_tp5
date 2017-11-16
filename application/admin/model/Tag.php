<?php

namespace app\admin\model;

use houdunwang\arr\Arr;
use think\Db;
use think\Model;

class Tag extends Model
{
    protected $pk='tag_id';
    protected $table='tags';
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
        $result = $this->validate(true)->save($data,['tag_id'=>$id]);
        //dd($result);die;
        if(false === $result){
            // 验证失败 输出错误信息
            return ['code'=>0,'msg'=>$this->getError ()];
        }else{
            return ['code'=>1,'msg'=>'操作成功'];
        }
    }

    //获取排除自己和子集的数据
    public function getTagData($id){
        //获取所有数据
        $data=Db::table('tags')->select();
        //获取所有子集id
        $ids=$this->getson($data,$id);
        //dd($ids);die;
        //将自己加进去
        $ids[]=$id;
        //dd($ids);die;
        //查找到排除之后的数据
        $data=Db::table('tags')->whereNotIn('tag_id',$ids)->select();
        return Arr::tree($data, 'tag_name', $fieldPri = 'tag_id', $fieldPid = 'pid');
    }

    //获取所有子集id
    public function getson($data,$id){
        static $temp=[];//定义静态属性接受tag_id
        //递归查询tag_id
        foreach ($data as $k=>$v){
            //查找当前的所属子集
            if ($id == $v['pid']){
                //添加到$temp数组中
                $temp[]=$v['tag_id'];
                $this->getson($data,$v['tag_id']);
            }
        }
        return $temp;
    }
}
