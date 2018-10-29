<?php
namespace app\api\controller;
use think\Controller;
use think\facade\Session;
use think\facade\Request;
use think\facade\Cache;



class Common extends Controller
{   
    //检查是否登录
    public function initialize()
    {
		if(!session('api_username')){
			 $this->redirect('api/login/login');
		}
		define('API_UID', session('api_uid'));
		//echo session('api_uid');
		//echo session('api_username');
	}	

}