<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Role extends Common
{
    public function index()
    {
    	$list = Db::name('role')->paginate(15);
    	$count = Db::name('role')->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch('admin_role');
    }
    public function role_add()
    {
    	$list = Db::name('auth_rule')->where('pid','0')->order('sort', 'desc')->select();
    	
    	foreach ($list as $key=>$value) {
    		
		  $list[$key]['new_data'] = Db::name('auth_rule')->where(array('pid'=>$value['id']))->order('sort', 'desc')->select();

		}

    	$this->assign('list',$list);
    	
        return $this->fetch('role_add');
    }    
    public function addPost()
    {
    	
    	
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
       	
       	
       	$res=Db::name('role')->where('name',$data['name'])->find();
       	if($res){
       		$info=['status' => '0','code'=>'003','msg'=>'用户名已存在'];
       	}else{
       		$in_data['name']=$data['name'];
       		$in_data['remark']=$data['remark'];
       		$in_data['ids']=$ids2;
       		$in_data['status']='1';
       		$in_data['create_time']=time();
       		
       		$list=Db::name('role')->insert($in_data);
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
    	$id=$this->request->param('id');
    	$list = Db::name('auth_rule')->where('pid','0')->order('sort', 'desc')->select();
    	
    	foreach ($list as $key=>$value) {
    		
		  $list[$key]['new_data'] = Db::name('auth_rule')->where(array('pid'=>$value['id']))->order('sort', 'desc')->select();

		}

    	
    	if($id){
    	 	$rule = Db::name('role')->where(array('id'=>$id))->find();
    	 	$ids=explode(",",$rule['ids']);
    	 	
    	 	$this->assign('ids',$ids);
    	 	$this->assign('rule',$rule);
    	} 
    	$this->assign('list',$list);     	
    	return $this->fetch('role_edit');
    }
    public function editPost()
    {
    	$id=$this->request->param('id');
		$remark=$this->request->param('remark');
       	$ids = $this->request->param('ids/a');
       	$ids2 = implode(",", $ids);
       	
       	$in_data['remark']=$remark;
       	$in_data['ids']=$ids2;
       	
//  	if ($id == 1) {
//          $info=['status' => '0','code'=>'002','msg'=>'管理员权限不可更改'];
//          return json($info);
//          exit;
//      }

		//$result = Db::name('role')->where(array('id'=>$id))->update($is_data);
		$result = Db::name('role')->where(array('id'=>$id))->update(['ids' => $ids2,'remark'=>$remark]);
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功',];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败',];
        }
		
		
		//$info=['status' => '0','code'=>'002','msg'=>'操作失败','ids'=>$ids2,'id'=>$id];
        return json($info);
    	
    }  
    public function delete()
    {
    	
    	$id=$this->request->param('id');
    	
    	if ($id == 1) {
            $info=['status' => '0','code'=>'002','msg'=>'管理员角色不能删除'];
            return json($info);
            exit;
        }
        
        $del=Db::name('role')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }      
}
