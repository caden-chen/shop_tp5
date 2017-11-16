<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
Route::get('c','index/cart/index');
Route::get('login','index/login/index');
Route::get('index','index/index/index');
Route::post('login','index/login/index');
Route::get('register','index/register/index');
Route::get('address','index/address/index');
Route::get('pl','index/personal/index');
Route::get('ol','index/orderlist/index');
Route::get('pay','index/pay/index');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '__rest__'=>[
        // 指向admin模块的slide控制器
        'slide'=>'admin/slide',
        'tag'=>'admin/tag',
        'goods'=>'admin/goods',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    '[l]'     => [
        ':tid'   => ['index/lists/index', ['method' => 'get'], ['tid' => '\d+']],
    ],
    '[g]'     => [
        ':gid'   => ['index/goods/index', ['method' => 'get'], ['gid' => '\d+']],
    ],
    '[o]'     => [
        ':oid'   => ['index/orders/index', ['method' => 'get'], ['oid' => '\d+']],
    ],
    '[s]'     => [
        ':oid'   => ['index/success/index', ['method' => 'get'], ['oid' => '\d+']],
        ':aid'   => ['index/success/index', ['method' => 'get'], ['aid' => '\d+']],
    ],
];

