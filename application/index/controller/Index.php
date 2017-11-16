<?php
namespace app\index\controller;

use houdunwang\arr\Arr;
use think\Db;
use think\Session;

class Index extends Common
{
    protected $temp = [];
    public function index()
    {
        //dd(time());die;
        //获取栏目数据
        $TagData=Db::table('tags')->select();
        $TagData=Arr::channelLevel($TagData,$pid=0, $html = "&nbsp;",'tag_id','pid');
        //dd($TagData);die;

        //获取轮播图数据
        $SlideData=Db::table('slide')->order('slide_id desc')->limit(3)->select();

        //获取推荐商品信息
        $recomData=Db::table('goods')->where('is_recommend',1)->order('time','desc')->limit(3)->select();

        //获取热门
        $hotData=Db::table('goods')->where('is_hot',1)->order('time','desc')->limit(4)->select();

        $data=Db::table('goods')->join('tags','goods.tid=tags.tag_id')->limit(3)->select();
        //halt($data);
        //处理楼层数据
        $cateData =  db('tags')->where('pid',0)->limit(2)->select();
        $allData=\db('tags')->select();
        //halt($cateData);
        foreach($cateData as $k=>$v) {
            $this->temp = [];
            $tag_ids = $this->getSon($allData, $v['tag_id']);
            $cateData[$k]['son'] = db('tags')->whereIn('tag_id', $tag_ids)->select();
            //组合当前标签和所有子集的商品数据
            $tag_ids[] = $v['tag_id'];
            $cateData[$k]['goods'] = db('goods')->whereIn('tid', $tag_ids)->order('time','desc')->limit(8)->select();
        }

       // halt($cateData);
        return $this->make('index',compact('TagData','SlideData','recomData','hotData','cateData','data'));
    }

    public function getSon($data,$tag_id){
        foreach ($data as $k=>$v){
            //查找当前的所属子集
            if ($tag_id == $v['pid']){
                //添加到$temp数组中
                $this->temp[]=$v['tag_id'];
                $this->getson($data,$v['tag_id']);
            }
        }
        return $this->temp;
    }
    //退出
    public function out(){
        Session::clear();
        return ['code'=>1,'msg'=>'退出成功'];
    }
}
