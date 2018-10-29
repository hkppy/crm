<?php
namespace app\api\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Validate;
use app\api\model\User as UserModel;


use app\common\validate\Customer as CustomerValidate;

class Login extends Controller
{
    public function login()
    {
    	session('api_username','心心相印');
    	session('api_uid','6');
    	echo session('api_username');
    	echo session('api_uid');
        echo 1111;
    }

    public function login_check()
    {
        $user=new UserModel;
        $validate=new  CustomerValidate;

        $data = request()->param();
        if (!$validate->scene('api_user_login')->check($data)) {
            $this->error($validate->getError());
        }

        $list = $user->where('username', $data['username'])->field('id,username,password,user_type,status')->find();

        if(!$list){
            $this->error('用户名不存在，请更换用户名');
        }

        if($list['password']!=md5($data['password'])){
            $this->error('密码错误，请更换密码');
        }else{

            if($list['status']=='3'){
                $this->error('该用户已离职，请联系管理员！');
            }else{
                echo session('api_uid', $list['id']);//用户ID
                echo session('api_username', $list['username']);//用户用户名
                session('api_user_type',$list['user_type']);//权限ID
                session('api_status',$list['status']);//账号状态
                $user->login_log($list['id']);
                $this->success('登录成功');
            }




        }
    }
	//退出登录
	public function logout()
	{ 
	   session(null);
	   //$this->success('登出成功！',url('/admin/login/index'));
	   $this->success('安全退出成功','api/login/login');
	}
      
    public function Verify()
    {
		return $this->fetch('Verify');
    }    
        
}
