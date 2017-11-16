<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;

class Login extends Controller
{
    //登录验证
    public function index(Request $request){
        //dd(md5('admin888'));
        //判断是否点击登录按钮
        if (request()->isPost()){
            //接受post数据
            $data=$request->post();

            $result = $this->validate($data,'Login');

            if(true !== $result){//失败提示并返回登录
                $this->error($result);
            }else{
                //将username存入session方便调用和验证
                Session::set('admin_name',$_POST['username']);
                //成功提示
                $this->success('登录成功', 'Entry/index');
            }
        }
        return view();
    }


}