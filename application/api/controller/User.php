<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\Validate;


use app\api\model\User as UserModel;

class User extends Common
{
    /**
     * 显示资源列表
     */
    public function index()
    {

    }
    //查询用户资料
    public function edit()
    {
    	
    	$user = new UserModel;
    	
    	$list=$user->where('id',API_UID)->field('id,username,avatar,nickname,phone,weixin,last_login_time')->find();
    	//$list=$user->get(session('api_uid'));
    	
    	if($list) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',$list);
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('用户不存在');
        }

    	
    }
	//修改用户资料
    public function edit_post()
    {
    	$user = new UserModel;
    	
    	$validate = new Validate([
            'nickname'      => 'require',
            'avatar'          => 'require',
            'sellid'        => 'require'
        ]);

        $validate->message([
            'nickname.require'          => '昵称不能为空!',
            'avatar.require'          => '头像不能为空!',
            'sellid.require' => '自定义销售ID不能为空!'
        ]);
		
        $data = $this->request->param();
        
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }
    	
    	
    	// $data['nickname']="心心相印";
    	// $data['avatar']="http://www.w3school.com.cn/ui2017/bg.png";
    	
    	$list=$user->user_edit($data);


    	if($list) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('修改失败');
        }
    }	    

    //修改密码
    public function pwd_edit_post()
    {
    	$user = new UserModel;
    	//自动验证
    	$validate = new Validate([
            'old_pwd'      => 'require',
            'pwd'          => 'require',
            'confirm_pwd'        => 'require'
        ]);

        $validate->message([
            'old_pwd.require'          => '原密码不能为空!',
            'pwd.require'          => '新密码不能为空!',
            'confirm_pwd.require' => '确认密码不能为空!'
        ]);
		
        $data = $this->request->param();
        
        
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

		$list = $user->pwd_edit($data['old_pwd'],$data['pwd'],$data['confirm_pwd']);
		return json($list);
    	
    	
    }
    
}
