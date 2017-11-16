<?php
namespace app\index\controller;

use think\Controller;

class Common extends Controller
{
    /**
     * 加载模板
     * @param string $tpl
     * @param string $data
     * @return \think\response\View
     */
    public function make($tpl='',$data='')
    {
        //获取当前请求的方法名：request ()->action  ()
        $tpl = $tpl ? $tpl : request ()->action  ();
        return view(ROOT_PATH.'template/'.$tpl.'.html',$data);
    }
}
