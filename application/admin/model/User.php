<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use think\facade\Request;
use app\admin\model\Role as RoleModel;
use app\admin\model\AuthRule as AuthRuleModel;
class User extends Model
{
    protected $auto = ['username','ip'];
    protected $insert = ['status' =>'1'];  
    protected $update = ['ip','login_ip'];  
    protected $autoWriteTimestamp = true;
    protected $type = [
        'status'    =>  'integer',
        'score'     =>  'float',
        'birthday'  =>  'datetime',
    ];


    protected function setUsernameAttr($value)
    {
        return strtolower($value);
    }

    protected function setIpAttr()
    {
        return request()->ip();
    }
     public function profile()
    {
        return $this->hasOne('role','id','role_id');
    }

    public function auth_check($uid)
    {
        $list=$this->where('id', $uid)->field('id,username,role_id')->find();
        $role=new RoleModel;
        if($list['role_id']=='1'){
            return true;
        }else{



        $list2=$role->get($list['role_id']);

        $user_logs_m=request()->module();
        $user_logs_c=request()->controller();
        $user_logs_a=request()->action();
        $role_auth_action=strtolower($user_logs_m."/".$user_logs_c."/".$user_logs_a);

        $public_page=array('admin/index/welcome','admin/index/index');

        $isin = in_array($role_auth_action,$public_page);

        if(!$isin){
            $auth_rule=new AuthRuleModel;
            $login_role_list=$auth_rule->where(array('name'=>$role_auth_action))->find();
            $new_array=explode(',',$list2['ids']);

            if(in_array($login_role_list['id'],$new_array)){
                return true;
            }else{
                return false;
            }

        }else{
            return true;
        }
        }

    }

 
}