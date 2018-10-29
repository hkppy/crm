<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;
use think\Db;
use app\admin\model\Goods as GoodsModel;

class Goods extends Common
{
    public function index($id)
    {
	$user = new GoodsModel;
	dump($user);
	}
	
    public function search_address()
    {
    	//$q=$this->request->param('q');
    	
    	$q="张";
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
    public function search_goods()
    {
    	$q=$this->request->param('q');
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
    public function addPost()
    {

        $data['name']=$this->request->param('name');
        $data['appid']=$this->request->param('appid');
        $data['appsecret']=$this->request->param('appsecret');
		$data['status']='1';

        $res=Db::name('applist')->where('name',$data['name'])->find();
        if($res){
        	$info=['status' => '0','code'=>'003','msg'=>'应用名已存在，请更换！'];
        }else{

        	$data['status']='1';
        	$data['add_time']=time();

        	$list=Db::name('applist')->insert($data);
        	if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'操作成功'];
        	}else{
        		
        		$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        	}
        }

        return json($info);
        
    } 
    public function edit()
    {
    	$id=$this->request->param('id');
    	$list=Db::name('applist')->where(array('id'=>$id))->find();
    	//dump($list);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function editPost()
    {
    	
    	$id=$this->request->param('id');
    	$data['name']=$this->request->param('name');
        $data['appid']=$this->request->param('appid');
        $data['appsecret']=$this->request->param('appsecret');
    	
        $result = DB::name('applist')->where(array('id'=>$id))->update($data);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function delete()
    {
    	
    	$id=$this->request->param('id');

        
        $del=Db::name('applist')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    	    	       	    
}
