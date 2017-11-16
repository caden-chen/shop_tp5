<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\Slide as SlideModel;
class Slide extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data=SlideModel::paginate(10);
        return view('',compact('data'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,SlideModel $slideModel)
    {
        //判断是否为ajax请求
        if ( request ()->isAjax () ) {
            //调用模型中store方法，并且把post所有数据传到模型中
            $res = $slideModel->add ( input ( 'post.' ) );
            if($res['code']){
                $this->success ($res['msg'],'/slide');
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
        $data=SlideModel::get($id);
        return view('',compact('data'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id,SlideModel $slideModel)
    {
        //dd(request ()->isAjax ())
        if ( request ()->isAjax () ) {
            //调用模型中store方法，并且把post所有数据传到模型中
            //dd($request->method());die;
            $data=Request::instance()->put();
            $res = $slideModel->change ($data,$id);
            if($res['code']==1){
                $this->success ($res['msg'],'/slide');
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
        $res = SlideModel::destroy ($id);
        if($res){
            $this->success ('操作成功','index');
        }else{
            $this->error ('操作失败');
        }
    }
}
