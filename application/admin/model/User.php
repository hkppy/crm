<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use think\facade\Request;
use app\admin\model\Role as RoleModel;
use app\admin\model\AuthRule as AuthRuleModel;
class User extends Model
{
    protected $autoWriteTimestamp = true;

    protected $type = [
        'status'    =>  'integer',
        'score'     =>  'float',
        'birthday'  =>  'datetime',
    ];

    protected function buildParam($array)
    {
        $data=[];
        if (is_array($array)){
            foreach( $array as $item=>$value ){
                $data[$item] = $this->request->param($value);
            }
        }
        return $data;
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
    public function editData($data){

        if (isset($data['id'])){
            if (is_numeric($data['id']) && $data['id']>0){
                    //过滤post数组中的非数据表字段数据
                    $save = $this->allowField(true)->save($data,[ 'id' => $data['id']]);
            }else{
                $save  = $this->allowField(true)->save($data);
            }
        }else{
            $save  = $this->allowField(true)->save($data);
        }
        if ($save == 0 || $save == false) {
            $res=[  'code'=> 0,  'msg' => '数据更新失败', ];
        }else{
            $res=[  'code'=> 1,  'msg' => '数据更新成功',  ];
        }
        return $res;
    }

    //生成php随机数
    public function randomkeys($length)   
    {   
        $output='';
        for($a=0;$a<$length;$a++){
            $output.=chr(mt_rand(33,126));
        }
        return $output;
    }

    public function edit_pwd_key($pwd,$salt){
        $pwd=md5(md5($salt)."+".md5($pwd));
        return $pwd;
    }

    public function getUserList($map=[],$order = 'id desc',$limit=8,$page=1){

        $field="id,username,email,role_id,user_login,user_email,status,create_time";
        $map['status']=1;
        $data=$this->where($map)->field($field)
           ->limit($limit)
           ->page($page)
           ->order($order)->select();
        return $data;
    }


 
}