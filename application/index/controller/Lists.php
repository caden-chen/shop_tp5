<?php
namespace app\index\controller;

use app\admin\model\Tag;
use houdunwang\arr\Arr;
use think\Db;

class lists extends Common
{
    public function index()
    {
        //获取tid
        $tid=input('param.tid');
        //dd($tid);die;
        //获取所有子集数据
        $TagData=Db::table('tags')->select();
        $tids=(new Tag())->getson($TagData,$tid);
        $tids[]=$tid;
        $field=db::table('goods')->whereIn('tid',$tids)->order('time desc')->select();
        //dd($field);die;
        //dd($TagData);die;

        //获取子集标签
        $TagData=db::table('tags')->whereIn('tag_id',$tids)->select();

        //获取随机推荐商品信息
        $randData=Db::query("SELECT * FROM goods ORDER BY RAND() LIMIT 3");
        //dd($randData);die;


        return $this->make('list',compact('TagData','field','randData','TagData'));
    }

    /**
     * 找父集
     * @param $data
     * @param $tid
     * @return array
     */
    public function getFather($data , $tid){
        static  $temp = [];
        foreach($data as $k=>$v){
            if($v['tag_id'] == $tid){
                $temp[] = $v;
                $this->getFather ($data,$v['pid']);
            }
        }
        return $temp;
    }

}
