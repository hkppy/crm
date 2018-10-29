<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;
use think\Db;
use app\admin\model\USer as USerModel;
use app\admin\model\SellerContact as SellerContactModel;
use app\admin\model\SellerLevel as SellerLevelModel;
use app\admin\model\SellerGroup as SellerGroupModel;


class Attendance extends Common
{
    public function index()
    {

        $user=new USerModel;
        //echo session('admin_group_id');
    	if(session('admin_group_id')!='1'){

    		$list = $user->where('user_type','2')->where('id',ADMIN_UID)->paginate(15);
    		$count = $user->where('user_type','2')->where('id',ADMIN_UID)->count();
    	}else{
    		$list = $user->where('user_type','2')->where('status','<>','3')->paginate(15);
    		$count = $user->where('user_type','2')->where('status','<>','3')->count();
    	}

    	
    	foreach ($list as $key=>$value) {
    		$list[$key]['level_name'] = Db::name('seller_level')->where(array('id'=>$value['seller_level_id']))->value('name');
    		if(empty($list[$key]['level_name'])){
    			$list[$key]['level_name']='未关联等级';
    		}	
		}
    	
    	//dump($list);
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function add()
    {
    	return $this->fetch();
    }
    public function addPost()
    {

        $data['name']=$this->request->param('name');
        $data['appid']=$this->request->param('appid');
        $data['appsecret']=$this->request->param('appsecret');
		$data['status']='1';

        $res=Db::name('applist')->where('name',$data['name'])->find();
        if($res){
        	$info=['status' => '0','code'=>'003','msg'=>'应用名已存在，请更换！'];
        }else{

        	$data['status']='1';
        	$data['add_time']=time();

        	$list=Db::name('applist')->insert($data);
        	if($list){
        		$info=['status' => '1','code'=>'001','msg'=>'操作成功'];
        	}else{
        		
        		$info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        	}
        }

        return json($info);
        
    } 
    public function edit()
    {
    	$id=$this->request->param('id');
    	$list=Db::name('applist')->where(array('id'=>$id))->find();
    	//dump($list);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function editPost()
    {
    	
    	$id=$this->request->param('id');
    	$data['name']=$this->request->param('name');
        $data['appid']=$this->request->param('appid');
        $data['appsecret']=$this->request->param('appsecret');
    	
        $result = DB::name('applist')->where(array('id'=>$id))->update($data);
    	
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
		$list=Db::name('user')->where('id',$id)->update(array('status'=>'3'));

    	if ($list) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    
    public function user_status()
    {
    	
    	$id=$this->request->param('id');
		$status=$this->request->param('status');
        
        $list=Db::name('user')->where('id',$id)->update(array('status'=>$status));
    	if ($list) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }  
    public function recycle()
    {
    	//echo session('group_id');
    	$user=new USerModel;
    	if(session('admin_group_id')!='1'){
    		$list = $user->where('user_type','2')->where('id',ADMIN_UID)->where('status','=','3')->paginate(15);
    		$count = $user->where('user_type','2')->where('id',ADMIN_UID)->where('status','=','3')->count();
    	}else{
    		$list = $user->where('user_type','2')->where('status','=','3')->paginate(15);
    		$count = $user->where('user_type','2')->where('status','=','3')->count();
    	}
    	
    	foreach ($list as $key=>$value) {
    		$list[$key]['level_name'] = Db::name('seller_level')->where(array('id'=>$value['seller_level_id']))->value('name');
    		if(empty($list[$key]['level_name'])){
    			$list[$key]['level_name']='未关联等级';
    		}	
		}
    	
    	//dump($list);
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    }     	    	       	    
}
