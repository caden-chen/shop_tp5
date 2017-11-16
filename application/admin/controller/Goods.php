<?php

namespace app\admin\controller;

use app\admin\model\Spec;
use houdunwang\arr\Arr;
use think\Db;
use think\Request;
use app\admin\model\Goods as GoodsModel;
class Goods extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=GoodsModel::order('time desc')->paginate(10);
        return view('',compact('data'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $tagData=\app\admin\model\Tag::select();
        $tagData=Arr::tree($tagData, 'tag_name', $fieldPri = 'tag_id', $fieldPid = 'pid');
        return view('',compact('tagData'));
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,GoodsModel $goodsModel)
    {
        //判断是否为ajax请求
        if ( request ()->isAjax () ) {
            //dd($request->post());die;
            //调用模型中store方法，并且把post所有数据传到模型中
            $res = $goodsModel->add ( input ( 'post.' ) );
            if($res['code']){
                $this->success ($res['msg'],'/goods');
            }else{
                $this->error ($res['msg']);
            }
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //标签数据
        $tagData=\app\admin\model\Tag::select();
        $tagData=Arr::tree($tagData, 'tag_name', $fieldPri = 'tag_id', $fieldPid = 'pid');

        //商品数据
        $data=GoodsModel::get($id);
        $pics=empty($data['pics'])?[]:explode(",",$data['pics']);
        //dd($pics);die;
        //规格参数数据
        $spec=Spec::where('gid',$id)->select();
        $spec=json_encode($spec);
        return view('',compact('data','tagData','spec','pics'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id,GoodsModel $goodsModel)
    {
        if ( request ()->isAjax () ) {
            //调用模型中store方法，并且把post所有数据传到模型中
            //dd($request->method());die;
            Db::table('spec')->where('gid',$id)->delete();
            $data=Request::instance()->put();
            //dd($data['pics']);die;
            $res = $goodsModel->change ($data,$id);
            if($res['code']==1){
                $this->success ($res['msg'],'/goods');
            }else{
                $this->error ($res['msg']);
            }
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //echo $id;die;
        $res = GoodsModel::destroy ($id);
        if($res){
            Db::table('spec')->where('gid',$id)->delete();
            $this->success ('操作成功','index');
        }else{
            $this->error ('操作失败');
        }
    }
}
