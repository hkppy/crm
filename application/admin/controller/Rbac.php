<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\AuthRule as AuthRuleModel;
class Rbac extends Common
{
    public function index()
    {



        $auth_rule=new AuthRuleModel;

        $list= $auth_rule->order('sort', 'desc')->paginate(100);
        $count= $auth_rule->count();
        $page = $list->render();

        $list=$this->getTree($list);

        foreach($list as $key=>$value){

             $list[$key]['pid_name']=$auth_rule->get_pid_cate($value['pid']);
        }


    	$this->assign('page',$page);
    	$this->assign('list',$list);
    	$this->assign('count',$count);
        return $this->fetch('admin_permission');
    }
    
    public function getTree($data,$pid=0,$level=0){
        static $arr=array();
        foreach($data as $key=>$value){
            if($value['pid'] == $pid){
                $value['level']=$level;     //用来作为在模版进行层级的区分
                $arr[] = $value;            //把内容存进去
                $this->getTree($data,$value['id'],$level+1);    //回调进行无线递归
            }
        }
        return $arr;

    }   
    

    public function permission_add()
    {
    	
    	$list = Db::name('auth_rule')->where('pid','0')->order('sort', 'desc')->select();
    	
    	foreach ($list as $key=>$value) {
    		
		  $list[$key]['new_data'] = Db::name('auth_rule')->where(array('pid'=>$value['id']))->order('sort', 'desc')->select();

		}
    	
    	
    	//dump($list);
    	
    	$this->assign('list',$list);
    	return $this->fetch('permission_add');
    }
    public function addPost()
    {
    	$data['title']=$this->request->param('title');
    	$data['name']=$this->request->param('name');
    	$data['note']=$this->request->param('note');
    	$data['pid']=$this->request->param('pid');
    	$data['sort']=$this->request->param('sort');
    	$data['status']=$this->request->param('status');
    	$data['is_display']=$this->request->param('is_display');
    	$data['style_id']=$this->request->param('style_id');
    	$data['font_code']=$this->request->param('font_code');
    	
    	
    	$res=Db::name('auth_rule')->where('name',$data['name'])->find();
    	if($res){
    		$info=['status' => '0','code'=>'003','msg'=>'权限名称已存在,请修改！',];
    		return json($info);
    		exit;
    	}    	
    	
    	$list=Db::name('auth_rule')->insert($data);
    	
    	if($list){
    		$info=['status' => '1','code'=>'001','msg'=>'操作成功',];
    	}else{
    		$info=['status' => '0','code'=>'002','msg'=>'操作失败',];
    	}

        return json($info);
        
    } 
    public function rbac_edit()
    {
    	$id=$this->request->param('id');
    	
    	$list = Db::name('auth_rule')->where('pid','0')->order('sort', 'desc')->select();
    	
    	foreach ($list as $key=>$value) {
    		
		  $list[$key]['new_data'] = Db::name('auth_rule')->where(array('pid'=>$value['id']))->order('sort', 'desc')->select();

		}
    	 
    	 if($id){
    	 	$auth_rule = Db::name('auth_rule')->where(array('id'=>$id))->find();
    	 	//dump($admin_user);
    	 	$this->assign('auth_rule',$auth_rule);
    	 }
    	$this->assign('list',$list);
		return $this->fetch('rbac_edit');
    } 
    public function editPost()
    {
    	$id=$this->request->param('id');
    	$is_data['title']=$this->request->param('title');
    	$is_data['name']=$this->request->param('name');
    	$is_data['note']=$this->request->param('note');
    	$is_data['pid']=$this->request->param('pid');
    	$is_data['sort']=$this->request->param('sort');
    	$is_data['style_id']=$this->request->param('style_id');
    	$is_data['font_code']=$this->request->param('font_code');
    	$is_data['status']=$this->request->param('status');
    	$is_data['is_display']=$this->request->param('is_display');
    	$result = DB::name('auth_rule')->where(array('id'=>$id))->update($is_data);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功',];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败',];
        }
		return json($info);
    	
    }
    public function delete()
    {
    	
    	$id=$this->request->param('id');
        $del=Db::name('auth_rule')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功',];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败',];
        }
		return json($info);
    }              
}
