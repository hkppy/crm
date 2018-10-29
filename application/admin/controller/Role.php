<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Role as RoleModel; 
use app\admin\model\AuthRule as AuthRuleModel;

class Role extends Common
{
    public function index()
    {
      $role=new RoleModel;
    	$list = $role->paginate();
    	$count = $role->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch('admin_role');
    }
    public function role_add()
    {
      $auth_rule=new AuthRuleModel;
    	$list =  $auth_rule->where('pid','0')->order('sort', 'desc')->select();
    	
    	foreach ($list as $key=>$value) {
    		
		  $list[$key]['new_data'] =  $auth_rule->where(array('pid'=>$value['id']))->order('sort', 'desc')->select();

		}

    	$this->assign('list',$list);
    	
        return $this->fetch('role_add');
    }    
    public function addPost()
    {
    	$role=new RoleModel;
    	
		//print_r($_POST);//只能获取name值 
        $data['name']=$this->request->param('name');
        $data['remark']=$this->request->param('remark');
       	$ids = $this->request->param('ids/a');
       	$ids2 = implode(",", $ids);
       	
       	if($data['name']==''){
       		$info=['status' => '0','code'=>'003','msg'=>'用户名不能为空'];
       		return json($info);
       		exit;
       	}
       	
       	
       	$res=$res->where('name',$data['name'])->find();
       	if($res){
       		$info=['status' => '0','code'=>'003','msg'=>'用户名已存在'];
       	}else{
       		$in_data['name']=$data['name'];
       		$in_data['remark']=$data['remark'];
       		$in_data['ids']=$ids2;
       		$in_data['status']='1';
       		$in_data['create_time']=time();
       		
       		$list=$res->insert($in_data);
       		if($list){
	      		$info=['status' => '1','code'=>'001','msg'=>'操作成功',];
	      	}else{
	      		$info=['status' => '0','code'=>'002','msg'=>'操作失败',];
	      	}
       	}
		//$info=['status' => '0','code'=>'002','msg'=>'操作失败','data'=>$data,'ids'=>$ids,'ids2'=>$ids2];
        return json($info);
        
    }
    public function role_edit()
    { 
      $role=new RoleModel;
      $auth_rule=new AuthRuleModel;


    	$id=$this->request->param('id');
    	$list = $auth_rule->where('pid','0')->order('sort', 'desc')->select();
    	
    	foreach ($list as $key=>$value) {
    		
		  $list[$key]['new_data'] = Db::name('auth_rule')->where(array('pid'=>$value['id']))->order('sort', 'desc')->select();

		}

    	
    	if($id){
    	 	$rule = $role->where(array('id'=>$id))->find();
    	 	$ids=explode(",",$rule['ids']);
    	 	
    	 	$this->assign('ids',$ids);
    	 	$this->assign('rule',$rule);
    	} 
    	$this->assign('list',$list);     	
    	return $this->fetch('role_edit');
    }
    public function editPost()
    {

      $role=new RoleModel;
      $auth_rule=new AuthRuleModel;

    	$id=$this->request->param('id');
		  $remark=$this->request->param('remark');
      $ids = $this->request->param('ids/a');
      $ids2 = implode(",", $ids);
       	
      $in_data['remark']=$remark;
      $in_data['ids']=$ids2;
       	
		  $result = $role->where(array('id'=>$id))->update(['ids' => $ids2,'remark'=>$remark]);
    	if ($result) {
    	$info=['status' => '1','code'=>'002','msg'=>'操作成功',];
      } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败',];
      }

      return json($info);
    	
    }  
    public function delete()
    {
    	$role=new RoleModel;
    	$id=$this->request->param('id');
    	
    	if ($id == 1) {
            $info=['status' => '0','code'=>'002','msg'=>'管理员角色不能删除'];
            return json($info);
            exit;
        }
        
        $del=$role->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }      
}
