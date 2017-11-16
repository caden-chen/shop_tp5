<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use think\Request;
use think\Session;

class Entry extends Common
{

    public function index()
    {
        return view();
    }

    //修改密码
    public function changePass(Request $request)
    {
        //判断是否点击确认按钮
        if (request()->isPost()) {
            //接受post数据
            $data = $request->post();
            //调用验证器类
            $result = $this->validate($data, 'Admin');
            if (true !== $result) {//失败提示并返回登录
                return $this->error($result);
            }
            $admin = new Admin();
            $password = [
                'password' => md5($data['new_password'])
            ];
            $admin->allowField(true)->save($password, ['username' => $data['username']]);
            //成功提示
            $this->success('操作成功', 'Login/index');
            Session::clear();
        }
        return view();

    }

    //退出登录
    public function out()
    {
        Session::clear();
        return $this->redirect('/admin/login');
    }
}