<?php
namespace app\api\model;

use think\Model;

class User extends Model
{
	protected $type = [
        'last_login_time'  =>  'timestamp',
	];

    protected function setUsernameAttr($value)
    {
        return strtolower($value);
    }
    protected function setIpAttr()
    {
        return request()->ip();
    }  
    public function comments()
    {
        return $this->hasMany('seller_contact','sid');
    }
    public function login_log($id){

        $this->where('id',$id)->inc('login_count')->update();
        $data['last_login_ip'] = request()->ip();
        $data['last_login_time']=time();
        $this->where(array('id'=>$id))->update($data);

    }

    public function pwd_edit ($old_pwd,$pwd,$confirm_pwd)
    {
		if($pwd!=$confirm_pwd){
    		$data = [ 'status' => '0','code' => 'PASS_ERROR1','msg' => '确认密码输入不一致'];
    		return $data;
    		exit;
    	}
    	
    	$list= $this->where(array('id'=>session('api_uid'),'password'=>md5($old_pwd)))->find();
    	if(!$list){
    		$data = [ 'status' => '0','code' => 'PASS_ERROR2','msg' => '原密码不正确'];
    		return $data;
    		exit;
    	}
    	
    	$list= $this->save([
			    'password' => md5($pwd)
			],['id' => session('api_uid')]);
		if($list){
			$data = [ 'status' => '1','code' => '200','msg' => '操作成功'];
			return $data;
    		exit;
		}else{
			$data = [ 'status' => '0','code' => 'PASS_ERROR2','msg' => '操作失败'];
			return $data;
    		exit;
		}	
			
    	
    }
    public function user_edit ($data=array())
    {
    	$list= $this->allowField(['nickname','avatar','sellid'])->save($data, ['id' => session('api_uid')]);
    	
        if($list){
            return true;
        }else{
            return false;
        }
    	
    }          
}