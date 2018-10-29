<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;

use app\admin\model\SellerGroup as SellerGroupModel;
use app\admin\model\User as UserModel;


class SellerGroup extends Common
{
    public function index()
    {
        $user=new UserModel;
        $seller_group=new SellerGroupModel;

        $list = $seller_group->paginate(15);
        $count = $seller_group->count();

    	foreach($list as $key=>$value){
            $list[$key]['sid_list']=$user->where('id', 'in', $value['group_sid'])->field('id,username')->select();


		}
		$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch();
    }
    public function getTree($data,$pid=0,$level=0){
        static $arr=array();
        foreach($data as $key=>$value){
            if($value['parent_id'] == $pid){
                $value['level']=$level;     //用来作为在模版进行层级的区分
                $arr[] = $value;            //把内容存进去
                $this->getTree($data,$value['id'],$level+1);    //回调进行无线递归
            }
        }
        return $arr;

    }

    public function add()
    
    {	
    	$list = Db::name('seller_group')->where('parent_id','0')->select();


    	$res= $this->getTree($list);

		//dump($res);

   		$this->assign('list',$res);
   		
   		$list2=Db::name('user')->where('user_type','2')->field('id,user_login')->select();
		
		foreach($list2 as $key=>$value){
			$data[$key]['id']=$value['id'];
			$data[$key]['name']=$value['user_login'];
			$data[$key]['flag']=false;
        }
   		
   		$this->assign('res',$res);
   		$this->assign('data',$data);
    	return $this->fetch();
    }
    public function addPost()
    {

        $data['group_name']=$this->request->param('group_name');
        
        $ids=$this->request->param('ids/a');
        $ids_string = implode(",",$ids) ;
        
        $data['group_sid']=$ids_string;
        
        $data['parent_id']='0';
		$res=Db::name('seller_group')->where('group_name',$data['group_name'])->find();
        if($res){
        	$info=['status' => '0','code'=>'003','msg'=>'名称已存在，请更换！'];
        }else{
        	$data['add_time']=time();

        	$list=Db::name('seller_group')->insert($data);
        	if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'操作成功','group_sid'=>$ids_string];
        	}else{
        		
        		$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        	}
        }

        return json($info);
        
    } 
    public function edit()
    {
    	$id=$this->request->param('id');

    	$res=Db::name('seller_group')->where(array('id'=>$id))->find();

    	$list = Db::name('seller_group')->where('parent_id','0')->select();

    	$list2=Db::name('user')->where('user_type','2')->field('id,user_login')->select();

    	$this->assign('list2',$list2);
   		$this->assign('list',$list);
    	//dump($list);
    	$this->assign('res',$res);
    	return $this->fetch();
    }
    public function editPost()
    {
    	
    	$id=$this->request->param('id');
    	$data['group_name']=$this->request->param('group_name');
        $ids=$this->request->param('ids/a');
         
        $ids_string = implode(",",$ids) ;
        
        $data['group_sid']=$ids_string;
        
        $result = DB::name('seller_group')->where(array('id'=>$id))->update($data);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function delete()
    {
    	
    	$id=$this->request->param('id');
		$del=Db::name('seller_group')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    
    public function user_json_list()
    {
    	
    	$id=$this->request->param('id');
		$list=Db::name('user')->where('user_type','2')->field('id,user_login')->select();
		
		foreach($list as $key=>$value){
			$data[$key]['importUnitId']=$value['id'];
			$data[$key]['importUnitName']=$value['user_login'];
			$data[$key]['flag']=false;
        }
//      if ($list) {
//  		$info=['status' => '1','code'=>'002','msg'=>'操作成功','data'=>$data];
//      } else {
//          $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
//      }

		return json($data);
    }        	    	       	    
}