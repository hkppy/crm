<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;
use think\Db;


class Applist extends Common
{
    public function index()
    {
    	$list = Db::name('applist')->paginate();
    	$count = Db::name('applist')->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	return $this->fetch();
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
	public function generate_password( $length = 8 ) { 
	// 密码字符集，可任意添加你需要的字符 
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|"; 
	$password = ""; 
	for ( $i = 0; $i < $length; $i++ ) 
	{ 
	// 这里提供两种字符获取方式 
	// 第一种是使用 substr 截取$chars中的任意一位字符； 
	// 第二种是取字符数组 $chars 的任意元素 
	// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1); 
	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
	} 
	return strtoupper(MD5($password)); 
	}       	    	       	    
}
