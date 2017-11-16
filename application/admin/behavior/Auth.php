<?php
namespace app\admin\behavior;
use think\Session;

class Auth
{
    use  \traits\controller\Jump;
    public function run(&$params){
        //dd(session('?admin_name'));
        if (!session('?admin_name')){
            return $this->redirect('/admin/login');

        }
    }
}