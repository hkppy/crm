<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;
use think\Db;


class Message extends Common
{
    public function index()
    {
    	$list = Db::name('message')->where(array('status'=>'1'))->select();
    	$count = Db::name('message')->where(array('status'=>'1'))->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
	
        return $this->fetch();


    }
    public function message(){
    	$list = Db::name('message')->where(array('status'=>'1','messages_type'=>'1'))->select();
    	$count = Db::name('message')->where(array('status'=>'1','messages_type'=>'1'))->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
	
        return $this->fetch();
    }
    public function announce(){
    	$list = Db::name('message')->where(array('status'=>'1','messages_type'=>'1'))->select();
    	$count = Db::name('message')->where(array('status'=>'1','messages_type'=>'1'))->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
	
        return $this->fetch();
    }    
    public function getTree($data,$pid=0,$level=0){
        static $arr=array();
        foreach($data as $key=>$value){
            if($value['pid'] == $pid){
                $value['level']=$level;     //用来作为在模版进行层级的区分
                $arr[] = $value;            //把内容存进去
                $this->getTree($data,$value['id'],$level+1);    //回调进行无线递归
            }
        }
        return $arr;

    }       
	public function add()
    {
    	return $this->fetch();
    }
    public function addPost()
    {

        $data['title']=$this->request->param('title');
        $data['messages_type']=$this->request->param('messages_type');
        $data['recipient_uid']=$this->request->param('recipient_uid');
        $data['content']=$this->request->param('content');
        $data['add_time']=time();
        $data['status']='1';
        
        if($data['messages_type']=='2'&&$data['recipient_uid']==''){
        	$info=['status' => '0','code'=>'002','msg'=>'消息类型为站内信时，收件人不能为空'];
        	return json($info);
        	exit;
        }

		$list=Db::name('message')->insert($data);
        if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'操作成功'];
        }else{
        		
        	$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }


        return json($info);
        
    }
    public function a_addPost()
    {

        $data['name']=$this->request->param('name');
        $data['pid']=$this->request->param('pid');
        $data['add_time']=time();
        $data['status']='1';

		$list=Db::name('message_category')->insert($data);
        if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'操作成功'];
        }else{
        		
        	$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }


        return json($info);
        
    }     
    public function edit()
    {
    	$id=$this->request->param('id');
    	
    	$list=Db::name('message')->where(array('id'=>$id))->find();
    	//dump($list);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function editPost()
    {
    	
    	$id=$this->request->param('id');
    	$data['title']=$this->request->param('title');
        $data['recipient_uid']=$this->request->param('recipient_uid');
        $data['content']=$this->request->param('content');
        $data['update_time']=time();
    	
        $result = DB::name('message')->where(array('id'=>$id))->update($data);
    	
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

        
        $del=Db::name('message')->where('id',$id)->update(array('status'=>'0'));
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function category()
    {
    	$product= Db::name('message_category')->where('status','1')->select();
		$list=$this->getTree($product);
		
    	$count = Db::name('message_category')->where('status','1')->count();
    	
    	foreach($list as $key=>$value){
    		if($value['pid']=='0'){
    			$list[$key]['pid_name']	="顶级分类";
    		}else{
    			$list[$key]['pid_name'] = Db::name('message_category')->where('id',$value['pid'])->value('name');
    			
    		}
    		
    	}	
    	
    	
    	//dump($list);
    	
    	$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    } 

   	public function recycle(){
   	    $list = Db::name('message')->where('status','<>','1')->select();
    	$count = Db::name('message')->where('status','<>','1')->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch();
   	}               	    	       	    
}
