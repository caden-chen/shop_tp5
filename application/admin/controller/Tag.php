<?php

namespace app\admin\controller;

use houdunwang\arr\Arr;
use think\Request;
use app\admin\model\Tag as TagModel;
class Tag extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $tagData=TagModel::select();
        $tagData=Arr::tree($tagData, 'tag_name', $fieldPri = 'tag_id', $fieldPid = 'pid');
        return view('',compact('tagData'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $tagData=TagModel::select();
        $tagData=Arr::tree($tagData, 'tag_name', $fieldPri = 'tag_id', $fieldPid = 'pid');
        return view('',compact('tagData'));
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,TagModel $tagModel)
    {
        //判断是否为ajax请求
        if ( request ()->isAjax () ) {
            //调用模型中store方法，并且把post所有数据传到模型中
            $res = $tagModel->add ( input ( 'post.' ) );
            if($res['code']){
                $this->success ($res['msg'],'/tag');
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
    public function edit($id,TagModel $tagModel)
    {
        $tagData=$tagModel->getTagData($id);
        $data=TagModel::get($id);
        return view('',compact('data','tagData'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id,TagModel $tagModel)
    {
        //dd(request ()->isAjax ())
        if ( request ()->isAjax () ) {
            //调用模型中store方法，并且把post所有数据传到模型中
            //dd($request->method());die;
            $data=Request::instance()->put();
            $res = $tagModel->change ($data,$id);
            if($res['code']==1){
                $this->success ($res['msg'],'/tag');
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

        $field=TagModel::get($id);
        $res=TagModel::where('pid',$field['tag_id'])->find();
        if ($res) return['code'=>0,'msg'=>'有子集栏目不能删除'];
        $res = TagModel::destroy ($id);
        if($res){
            $this->success ('操作成功','index');
        }else{
            $this->error ('操作失败');
        }
    }
}
