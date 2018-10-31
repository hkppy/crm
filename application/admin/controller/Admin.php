<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;
use think\facade\Cache;

use app\admin\model\User as UserModel;
use app\admin\model\Role as RoleModel; 
use app\admin\model\AuthRule as AuthRuleModel;

use app\common\validate\Admin as AdminValidate;

class Admin extends Common
{
    public function index()
    {
        $user=new USerModel;
        $role=new RoleModel;

        $map['status']=1;
        $field="id,username,email,role_id,user_login,user_email,status,create_time";
        
        $list = $user->with('profile')->where($map)->field($field)->paginate(15);
    	$count = $user->count();
    	foreach ($list as $key=>$value) {
		  $list[$key]['role_name']=$value['profile']['name'];
		}
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch('admin_list');
    }
    public function admin_add()
    {
        $role=new RoleModel;
    	$list =  $role->select();
    	$this->assign('role',$list);
    	return $this->fetch('admin_add');
    }
  
    public function addPost()
    {
    	if($this->request->isPost())
		{
    	$user = new UserModel;

        $validate = new AdminValidate;


        $data=$this->request->param();
        //dump($data);

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        } 

    	$salt=$user->randomkeys('6');
        if($data['password']!=$data['password2']){
        	$info=['status' => '0','code'=>'004','msg'=>'密码输入不一致'];
            return json($info);
            exit;
        }

        $res=$user->where('user_login',$data['username'])->find();
        if($res){
        	$info=['status' => '0','code'=>'003','msg'=>'用户名已存在，请更换用户名！'];
            return json($info);
            exit;
        }else{

        	$pwd=md5(md5($salt)."+".md5($data['password']));
        	$in_data['user_login']=$data['username'];
        	$in_data['username']=$data['username'];
        	$in_data['pwd_key']=$salt;
        	$in_data['user_pass']=$pwd;
        	$in_data['salt']=$salt;
        	$in_data['password']=$pwd;
        	$in_data['sex']=$data['sex'];
        	$in_data['phone']=$data['phone'];
        	$in_data['user_email']=$data['email'];
        	$in_data['note']=$data['note'];
        	$in_data['status']='1';
        	$in_data['create_time']=time();
        	$in_data['user_type']=$this->request->param('adminRole');
        	$in_data['role_id']=$this->request->param('adminRole');

        	$list=$user->insert($in_data);

        	if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'操作成功'];
        	}else{
        		
        		$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        	}
        }

        return json($info);
        
        }
        
    }
    public function admin_edit()
    {
        $user = new UserModel;
        $role=new RoleModel;
    	$id=$this->request->param('id');
    	 
    	if($id){
            $field="id,user_type,user_status,user_email,phone,user_login,sex,note";
    	 	$admin_user = $user->where(array('id'=>$id))->field($field)->find();
    	 	//dump($admin_user);
    	 	$this->assign('admin_user',$admin_user);
    	}
    	
    	$list = $role->select();
    	$this->assign('role',$list);
    	return $this->fetch('admin_edit');
    }      
    public function editPost()
    {
        $user = new UserModel;
    	if($this->request->isPost())
		{	
    	$id=$this->request->param('id');
    	$is_data['sex']=$this->request->param('sex');
    	$is_data['phone']=$this->request->param('phone');
    	$is_data['user_email']=$this->request->param('email');
    	$is_data['user_type']=$this->request->param('adminRole');
        $in_data['role_id']=$this->request->param('adminRole');
    	$is_data['note']=$this->request->param('note');

    	if($id=='1'){
    		$info=['status' => '0','code'=>'002','msg'=>'管理员角色不可修改',];
    		return json($info);
    		exit;
    	}

    	$result = $user->where(array('id'=>$id))->update($is_data);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
		
		}
    	
    }	    
    public function delete()
    {
    	$user = new UserModel;
    	$id=$this->request->param('id');
    	
    	if ($id == 1) {
            //$this->error("最高管理员不能删除！");
            $info=['status' => '0','code'=>'002','msg'=>'最高管理员不能删除'];
            return json($info);
            exit;
        }
        
        $del=$user->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function post_up()
    {
        $user = new UserModel;
    	$id=$this->request->param('id');
    	
    	$result = $user->where('id', $id)->update(['status' => '0']);
    	if($id=='1'){
    		$info=['status' => '0','code'=>'002','msg'=>'管理员不能禁用'];
    		return json($info);
    		exit;
    	}
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    	
    }        
    public function post_do()
    {
        $user = new UserModel;
    	$id=$this->request->param('id');
    	
    	$result = $user->where('id', $id)->update(['status' => '1']);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    	
    } 
    public function admin_change_password()
    {
        $user = new UserModel;
        $field='id,user_login';
    	$list = $user->where(array('id'=>ADMIN_UID))->field($field)->find();

    	$this->assign('list',$list);
    	return $this->fetch('admin_password_edit');
    }
    public function admin_change_password_Post()
    {
    	$user = new UserModel;
    	
    	$data=$this->request->param();
        
        $salt = $user->get($data['id'])->value('salt');

        $password2=$user->edit_pwd_key($data['oldpassword'],$salt);

        $list = $user->where(array('id'=>ADMIN_UID,'user_pass'=>$password2))->find();
            
        if(!$list){
                $info=['status' => '0','code'=>'002','msg'=>'原密码不正确'];
            }else{
                
            $salt2=$user->randomkeys('6');

            $new_password=$user->edit_pwd_key($data['new_password'],$salt2);

            $result = $user->where(array('id'=>ADMIN_UID))->update(array('user_pass'=>$new_password,'password'=>$new_password,'pwd_key'=>$salt2,'salt'=>$salt2));
            
            if ($result) {
                    $info=['status' => '1','code'=>'002','msg'=>'操作成功'];
            } else {
                    $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
            }
                
                
        }
        return json($info);



    	
    }
    public function user_password_edit(){
        $user = new UserModel;
    	$list = $user->where(array('id'=>ADMIN_UID))->field('id,user_login')->find();
    	$this->assign('list',$list);
    	return $this->fetch('admin_password_edit');
    }
     /**
     * 清除缓存
     */
    public function clear() {
    	
        $cache=Cache::clear(); 
        if ($cache) {
	    	$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
	    } else {
	        $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
	    }
        return json($info);
    }
    public function resetpwd(){

        $user = new UserModel;
        $data=$this->request->param();
        $list=$user->where('id',$data['id'])->field('id,username,salt')->find();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function reset_pwd_post(){
        $user = new UserModel;
        $data=$this->request->param();
        //dump($data);
        if(!empty($data['id'])){
            $salt = $user->where(array('id'=>$data['id']))->value('salt');
            if($data['salt']!=md5($salt)){
                 $this->error('密匙输入不正确');
            }else{
                $salt2=$user->randomkeys('6');
                $password=$user->edit_pwd_key($data['password'],$salt2);
                $result = $user->where(array('id'=>$data['id']))->update(array('user_pass'=>$password,'password'=>$password,'pwd_key'=>$salt2,'salt'=>$salt2));
                if ($result) {
                    $this->success('操作成功');
                }else{
                    $this->error('操作失败');
                }
            }
        }
    }
	    	    
}
