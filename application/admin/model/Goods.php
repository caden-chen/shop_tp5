<?php

namespace app\admin\model;

use think\Model;

class Goods extends Model
{
    protected $pk = 'goods_id';
    protected $table = 'goods';

    //添加
    public function add($data)
    {
        $data['pics']=isset($data['pics'])?implode(',',$data['pics']):'';
        //dd($data['pics']);die;
        $data['time']=time();
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->validate(true)->allowField(true)->save($data);
        if (false === $result) {
            // 验证失败 输出错误信息
            return ['code' => 0, 'msg' => $this->getError()];
        } else {
            $spec = json_decode($data['spec'], true);
            //dd($this->goods_id);die;
            foreach ($spec as $k => $v) {
                //dd($v);die;
                $model = new Spec();
                $model->combine = $v['combine'];
                $model->total = $v['total'];
                $model->gid = $this->goods_id;
                $model->allowField(true)->save();
            }
            return ['code' => 1, 'msg' => '操作成功'];
        }
    }

    public function change($data, $id)
    {
        //dd($id);die;
        $data['pics']=isset($data['pics'])?implode(',',$data['pics']):'';
        $data['time']=time();
        // 调用当前模型对应的User验证器类进行数据验证
        $result = $this->validate(true)->allowField(true)->save($data, ['goods_id' => $id]);
        //dd($result);die;
        if (false === $result) {
            // 验证失败 输出错误信息
            return ['code' => 0, 'msg' => $this->getError()];
        } else {
            //dd($data['spec']);die;
            $spec = json_decode($data['spec'], true);
            //dd($this->goods_id);die;
            foreach ($spec as $k => $v) {
                //dd($v);die;
                $model = new Spec();
                $model->combine = $v['combine'];
                $model->total = $v['total'];
                $model->gid = $id;
                $model->allowField(true)->save();
            }
            return ['code' => 1, 'msg' => '操作成功'];
        }
    }

}
