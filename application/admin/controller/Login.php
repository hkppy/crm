<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;
use think\facade\Config;
use think\facade\Session;

use app\admin\model\User as UserModel;

class Login extends Controller
{
    public function index()
    {
 
		return $this -> fetch();
    }
    
    public function check_login()
    {
    	
		$user = new UserModel;
		$username=$this->request->param('username');
        $password=$this->request->param('password');
        
        $list = $user->where('username', $username)->find();
        
		if($list){

            $password2=$user->edit_pwd_key($password,$list['salt']);
			$res = $user->where(array('username'=>$username,'password'=>$password2))->find();
			if($res){

				session('admin_uid', $res['id']);//用户ID
        		session('admin_username', $res['username']);//用户用户名
        		session('admin_group_id', $res['user_type']);//分组ID
        		session('admin_user_type',$res['user_type']);//权限ID
        		session('admin_user_status',$res['status']);//账号状态
                session('admin_role_id',$res['role_id']);//账号状态
                
                $user->where('id', $res['id'])->setInc('login_count');
                $data2['last_login_time']=time();
                $data2['last_login_ip']=request()->ip();
                
                $user->save($data2,['id'=>$res['id']]);

        		//session('img', $img);
				$this->success('登录成功！',url('/admin/index'));
			}else{
				$this->error('密码错误');
			}
			
			
        }else{
            $this->error('用户名不存在请更换用户名');
        }

        
    }
    
 
    // 验证码检测
    public function check($code='')
    {
        if (!captcha_check($code)) {
            $this->error('验证码错误');
        } else {
            return true;
        }
    }
	
//退出登录
	public function logout()
	{ 
	   session(null);
	   $this->success('登出成功！',url('/admin/login/index'));
	}

    public function Verify()
    {
		return $this->fetch('Verify');
    } 	
	
}
