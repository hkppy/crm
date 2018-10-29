<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\api\model\Goods as GoodsModel;

class Goods extends Common
{
    public function index($id)
    {
	$user = new GoodsModel;
	dump($user);
	}
	
    public function search_address($q='')
    {

    	if(!empty($q)){
    	$list = Db::name('address')->where('name|address','like',$q."%")->limit('3')->select();
		if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'搜索成功','data'=>$list];
        }else{
        		
        		$info=['status' => '0','code'=>'002','msg'=>'搜索失败'];
       	}
		return json($info);
		}
    }
    public function search_goods(($q='')
    {
    	if(!empty($q)){
    	$list = Db::name('goods')->where('goods_name','like',"%".$q."%")->limit('3')->select();

    	
		if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'搜索成功','data'=>$list];
        }else{
        		
        		$info=['status' => '0','code'=>'002','msg'=>'搜索失败'];
       	}
		return json($info);
		}
    }

    	    	       	    
}
