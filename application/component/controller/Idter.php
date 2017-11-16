<?php
namespace app\component\controller;
use think\Controller;
use think\Request;

class Idter extends Controller
{
    public function upload(Request $request){
        //dd($_POST);
        //dd($_FILES);die;
        // 获取表单上传文件 例如上传了001.jpg
        $file = $request->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        return json_encode(['code' => 0, 'msg' =>'上传成功','data'=>['src'=>'/uploads/'.$info->getSaveName()],'title'=>'']);
    }
}