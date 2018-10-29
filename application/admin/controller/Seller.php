<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
//加载Facade类
use think\facade\Session;
use think\facade\Request;
use think\facade\Cache;
use think\facade\Validate;
use think\facade\Debug;
use think\facade\Url;

//加载模型
use app\admin\model\User as UserModel;
use app\admin\model\Goods as GoodsModel;
use app\admin\model\Apilist as ApilistModel;
use app\admin\model\Article as ArticleModel;
use app\admin\model\Customer as CustomerModel;
use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\model\SellerLevel as SellerLevelModel;
use app\admin\model\SellerGroup as SellerGroupModel;
use app\admin\model\CustomerInfo as CustomerInfoModel;
use app\admin\model\SellerContact as SellerContactModel;
use app\admin\model\CustomerExpend as CustomerExpendModel;
use app\admin\model\ArticleCategory as ArticleCategoryModel;

class Seller extends Common
{
    public function index()
    {
        $user=new USerModel;
        $seller_contact=new SellerContactModel;
        $seller_level=new SellerLevelModel;
        $seller_group=new SellerGroupModel;
        

        $list = $user->where('user_type','2')->select();
        $count = $user->where('user_type','2')->count();
    	

    	foreach ($list as $key=>$value) {
    		//微信数据
    		$list[$key]['wx_seller_contact_list'] = $seller_contact->where(array('sid'=>$value['id'],'type'=>'1'))->select();
    		//QQ数据
    		$list[$key]['qq_seller_contact_list'] = $seller_contact->where(array('sid'=>$value['id'],'type'=>'2'))->select();	
			
			$group_sid=Db::name('seller_group')->where('group_sid','like',"%".$value['id']."%")->column('id');
			
            $list[$key]['group_sid']=implode(",", $group_sid);
		}
        
    	$seller_level_list = $seller_group->where(array('parent_id'=>'0'))->select();
    	
    	$this->assign('seller_level_list',$seller_level_list);
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function add()
    {
    	$list = Db::name('seller_level')->where(array('pid'=>'0'))->select();
    	$this->assign('list',$list);
    	return $this->fetch('add');
    }
  
    public function addPost()
    {

        $data['seller_level_id']=$this->request->param('seller_level_id');
        
        $data['user_login']=$this->request->param('user_login');
        $data['username']=$this->request->param('user_login');
        $data['sellid']=$this->request->param('sellid');
		$password=$this->request->param('password');
		$data['create_time']=time();
		$data['add_time']=time();
		
		$password2=$this->request->param('password2');
		
		if($password!=$password2){
			$info=['status' => '0','code'=>'003','msg'=>'密码输入不一致'];
			 return json($info);
			exit;
		}
		$data['user_pass']=md5($password);
		$data['password']=md5($password);
		
		
		$data['user_type']='2';
		$data['status']='1';
		
		$res=Db::name('user')->where('user_login',$data['user_login'])->find();
        if($res){
        	$info=['status' => '0','code'=>'003','msg'=>'用户名已存在'];
        }else{
        	
        	$list=Db::name('user')->insert($data);
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

        $user=new USerModel;
        $seller_contact=new SellerContactModel;
        $seller_level=new SellerLevelModel;
        $seller_group=new SellerGroupModel;
    	$id=$this->request->param('id');
    	 
    	$res = $seller_level->select();
    	
    	$this->assign('res',$res);
    	 
    	if($id){
    	 	$list = $user->where(array('id'=>$id))->find();
    	 	//dump($admin_user);
    	 	$this->assign('list',$list);
    	}
		//dump($list);
    	$this->assign('list',$list);
    	return $this->fetch('edit');
    }      
    public function editPost()
    {
        $user=new USerModel;
        $seller_contact=new SellerContactModel;
        $seller_level=new SellerLevelModel;
        $seller_group=new SellerGroupModel;
        
    	if($this->request->isPost()){
    		
    	$id=$this->request->param('id');
		$is_data['user_login']=$this->request->param('user_login');
    	$is_data['seller_level_id']=$this->request->param('pid');
		$is_data['sellid']=$this->request->param('sellid');

		$result = $user->where(array('id'=>$id))->update($is_data);
		
    	if ($result) {
    		$info=['status' => '1','code'=>'200','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
		}
    	
    }	    
    public function delete()
    {
    	
    	$id=$this->request->param('id');
        
        $del=Db::name('seller')->where('id',$id)->delete();
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


        $seller_contact=new SellerContactModel;
        $seller_level=new SellerLevelModel;
        $seller_group=new SellerGroupModel;
        $user=new USerModel;
        
    	
    	$id=$this->request->param('id');
    	$data='';
    	if(!empty($id)){
    		$data['sid']=$id;
        }

    	$list = $seller_contact->where($data)->order('id', 'desc')->paginate(15);
        $count = $seller_contact->count();

    	foreach ($list as $key=>$value) {
    	if($value['sid']!=''){
    	$role_list[$key] = $user->where(array('id'=>$value['sid']))->field('id,user_login')->find();
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
 	public function seller_status_editPost(){  


 		$seller_contact=new SellerContactModel;
 		$wq=$this->request->param('wq/a');


 		//$result = DB::name('seller_contact')->update(['online' => '1']);
 		$seller_contact->where('online', 1)->update(['online' => '0']);



        $result=$seller_contact->where('id','in',$wq)->update(['online' => '1']);

        if ($result) {
            $info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
        Cache::pull('dashi_list');
        return json($info); 
 	}                    		       
}
