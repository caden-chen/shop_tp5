<?php
namespace app\admin\controller;

use think\Controller;
use think\Hook;

class Common extends Controller
{

    public function _initialize()
    {
        Hook::listen('CheckAuth',$params);
    }
}