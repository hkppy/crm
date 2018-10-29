<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class SellerLevel extends Common
{
    public function index()
    {
    	//echo session('group_id');

    	$list = Db::name('seller_level')->paginate(15);
    	$count = Db::name('seller_level')->count();
		//dump($list);
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function add()
    {
    	$list = Db::name('seller_level')->select();
    	//dump($list);
    	$this->assign('list',$list);
    	return $this->fetch('add');
    }
  
    public function addPost()
    {

        $data['name']=$this->request->param('name');
        $data['pid']=$this->request->param('pid');
		$data['add_time']=time();

        	
        $list=Db::name('seller_level')->insert($data);
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
    	 
    	$list = Db::name('seller_level')->where(array('pid'=>'0'))->select();
    	
    	
    	$this->assign('list',$list);
    	 
    	if($id){
    	 	$res = Db::name('seller_level')->where(array('id'=>$id))->find();
    	 	$this->assign('res',$res);
    	}
    	return $this->fetch('edit');
    }      
    public function editPost()
    {
    	$id=$this->request->param('id');
    	
    	$data['pid']= $this->request->param('pid');
		$data['name'] = $this->request->param('name');

		$result = DB::name('seller_level')->where(array('id'=>$id))->update($data);
		
    	if ($result) {
    		$info=['status' => '1','code'=>'200','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    	
    }	    
    public function delete()
    {
    	
    	$id=$this->request->param('id');
        
        $del=Db::name('seller_level')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function show()
    {
    	$id=$this->request->param('id');
    	$list=Db::name('seller_contact')->where(array('id'=>$id))->find();
    	return $this->fetch('show');
    }
    public function user_list()
    {
    	
    	$id=$this->request->param('id');
    	
    	if(!empty($id)){
    		
    		$list = Db::name('seller_contact')->where(array('sid'=>$id))->select();
	    	$count = Db::name('seller_contact')->where(array('sid'=>$id))->count();
    		
    	}else{
    		
    		$list = Db::name('seller_contact')->select();
	    	$count = Db::name('seller_contact')->count();
	    }	
    	

    	foreach ($list as $key=>$value) {
    	if($value['sid']!=''){
    	$role_list[$key] = Db::name('user')->where(array('id'=>$value['sid']))->field('id,user_login')->find();
		$list[$key]['seller_name']=$role_list[$key]['user_login'];
    	}else{
    		$list[$key]['seller_name']="未绑定";
    	}	
		}
    	
    	
		//dump($list);
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch('user_list');
    }
    public function xs_add()
    {
		
    	return $this->fetch('xs_add');
    }
    public function xs_addPost(){
    	$data['type']=$this->request->param('type');
    	$data['name']=$this->request->param('name');
        $data['value']=$this->request->param('value');
        $data['sort']=$this->request->param('sort');
        $data['online']=$this->request->param('online');
        
        $data['qrcode']=$this->request->param('qrcode');
		$data['add_time']=time();
    	$res=Db::name('seller_contact')->where('value',$data['value'])->find();
        if($res){
        	$info=['status' => '0','code'=>'003','msg'=>'联系方式已存在，请修改！'];
        }else{
        	
        	$list=Db::name('seller_contact')->insert($data);
        	if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'操作成功'];
        	}else{
        		
        		$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        	}
        }
        return json($info);	

    }
	 public function seller_contact_edit(){
	 	$id=$this->request->param('id');
    	$list=Db::name('seller_contact')->where(array('id'=>$id))->find();
    	$this->assign('list',$list);
	 	return $this->fetch('seller_contact_edit');
	} 
    public function xs_editPost(){
    	$id=$this->request->param('id');
    	$data['type']=$this->request->param('type');
    	$data['name']=$this->request->param('name');
        $data['value']=$this->request->param('value');
        $data['qrcode']=$this->request->param('qrcode');
		$data['sort']=$this->request->param('sort');
		$data['online']=$this->request->param('online');
		
		$list=Db::name('seller_contact')->where(array('id'=>$id))->update($data);
        if($list){
        	$info=['status' => '1','code'=>'001','msg'=>'操作成功'];
        }else{
        		
        	$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }

        return json($info);	

    }
    public function xs_delete()
    {
    	
    	$id=$this->request->param('id');

        $del=Db::name('seller_contact')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    } 
    public function xs_show()
    {
    	$sid=$this->request->param('sid');
    	$list=Db::name('user')->where(array('id'=>$sid))->find();
    	//dump($list);
    	$this->assign('list',$list);
    	return $this->fetch('xs_show');
    } 
    public function seller_password_edit()
    {
    	$id=$this->request->param('id');
    	$list=Db::name('seller')->where(array('id'=>$id))->find();
    	//dump($list);
    	$this->assign('list',$list);
    	return $this->fetch('seller_password_edit');
    }
    public function admin_change_password_Post(){
    	$id=$this->request->param('id');
    	
    	$oldpassword=$this->request->param('oldpassword');
    	$oldpassword=md5($oldpassword);
    	$new_password=$this->request->param('new_password');
    	$new_password=md5($new_password);
    	
    	$list=Db::name('seller')->where(array('id'=>$id,'pass_word'=>$oldpassword))->find();
    	
    	if($list){
    		
    		$result = DB::name('seller')->where('id', $id)->update(['pass_word' => $new_password]);
    		if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
	        } else {
	            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
	        }
    	}else{
    		$info=['status' => '1','code'=>'002','msg'=>'原密码不正确'];
    	}

    	return json($info);
    }
    
    
    public function post_up()
    {
    	$id=$this->request->param('id');
    	
    	$result = DB::name('user')->where('id', $id)->update(['status' => '0']);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    	
    }        
    public function post_do()
    {
    	$id=$this->request->param('id');
    	
    	$result = DB::name('user')->where('id', $id)->update(['status' => '1']);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    	
    }
    
    public function seller_post_up()
    {
    	$id=$this->request->param('id');
    	
    	$result = DB::name('seller_contact')->where('id', $id)->update(['online' => '0']);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    	
    }        
    public function seller_post_do()
    {
    	$id=$this->request->param('id');
    	
    	$result = DB::name('seller_contact')->where('id', $id)->update(['online' => '1']);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    	
    }    
    public function seller_show()
    {
    	$sid=$this->request->param('sid');
    	$this->assign('sid',$sid);
		return $this->fetch('seller_show');
    } 
    public function seller_show_editPost(){

    	$sid=$this->request->param('sid');
    	$data['type']=$this->request->param('type');
    	$data['name']=$this->request->param('name');
        $data['value']=$this->request->param('value');
        $data['qrcode']=$this->request->param('qrcode');
        $data['sort']=$this->request->param('sort');
        $data['online']=$this->request->param('online');
        $data['uid']=session('uid');
		
		$data['sid']=$sid;
		$data['add_time']=time();
        $result=Db::name('seller_contact')->insert($data);
        if ($result) {
		    $info=['status' => '1','code'=>'002','msg'=>'操作成功'];
		} else {
		    $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
		}

        return json($info);	

    }                        		       
}
