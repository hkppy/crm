<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\facade\Request;
use think\facade\Debug;

use app\admin\model\User as UserModel; 
class Common extends Controller
{   
    //检查是否登录
    public function initialize()
    {
		if(!session('admin_username')){
			 //$this->error('请先登录！',url('/admin/login/index'));
			 $this->redirect('admin/login/index');
		}
		define('ADMIN_UID', session('admin_uid'));
		define('ADMIN_USERNAME', session('admin_username'));
		define('ROLE_UID', session('admin_user_type'));

		$check_user = new UserModel;
		$common_check_user = $check_user->get(session('admin_uid'));
		
		if(!$common_check_user){
			session(null);
			$this->error('用户不存在','admin/login/index');
		}
		//echo session('uid');
		//echo "</br>";
		//echo session('user_type');
		//echo session('user_status');
	    $common_list = Db::name('auth_rule')->where(array('pid'=>'0','status'=>'1','is_display'=>'1'))->order('sort', 'desc')->select();

    	foreach ($common_list as $key=>$value) {
    		
		  $common_list[$key]['new_data'] = Db::name('auth_rule')->where(array('pid'=>$value['id'],'status'=>'1','is_display'=>'1'))->order('sort', 'desc')->select();

		}
		
		$role_user_list=Db::name('role')->where(array('id'=>session('admin_user_type')))->field('id,name,ids')->find();
		$this->assign('role_user_list',$role_user_list);
		
		//dump($role_user_list);
		
		$login_user_list=Db::name('user')->where(array('id'=>ADMIN_UID))->field('last_login_ip,last_login_time,user_type,user_login')->find();
	
		$login_role_list=Db::name('role')->where(array('id'=>$login_user_list['user_type']))->find();

		$user_ids=$login_role_list['ids'];

		$user_ids_array = explode(",", $user_ids);
		
		
		$login_role_list_act=Db::name('auth_rule')->where('id','in',$user_ids_array)->column('name');
		
		//dump($login_role_list_act);
		
		$this->assign('login_role_list',$login_role_list);
		$this->assign('login_user_list',$login_user_list);
				
		$user_logs_m=$this->request->module();
		$user_logs_c=$this->request->controller();
		$user_logs_a=$this->request->action(); 
		
		$user_logs_list['ip']=$this->request->ip();
		
		
		
		$role_auth_action=strtolower($user_logs_m."/".$user_logs_c."/".$user_logs_a);
		
		
		$role_auth_action=htmlentities($role_auth_action);
		
		
		$login_role_list_tofd=Db::name('auth_rule')->where(array('name'=>$role_auth_action))->find();
		
		//dump($login_role_list_tofd);
		
		$login_role_list_tofd_one=Db::name('auth_rule')->where(array('id'=>$login_role_list_tofd['pid']))->find();
		//dump($login_role_list_tofd);
		
		$common_column_title['two_title']=$login_role_list_tofd['title'];
		$common_column_title['one_title']=$login_role_list_tofd_one['title'];

		//dump($common_column_title);
		$this->assign('common_column_title',$common_column_title);


		$role_auth_list=Db::name('auth_rule')->column('id');

		$intersection = array_intersect($user_ids_array, $role_auth_list);

		//公共访问控制器定义
		$pub_act_list = array("admin/index/index", "admin/index/welcome");


		if (!in_array($role_auth_action, $pub_act_list))
		{
			//判断私密控制器
			if($login_user_list['user_type']!='1'){
				if (!in_array($role_auth_action, $login_role_list_act))
				{
				$this->error('权限不足，本次操作已记录！',url('/admin/index/index'));
			
				}
			}
		}

		$user_logs_list['data']=json_encode($this->request->param());
		$user_logs_list['time']=time();
		$user_logs_list['note']="用户操作";
		$result=Db::name('user_logs')->insert($user_logs_list);
		$this->assign('common_list',$common_list);


	}	

}