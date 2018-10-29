<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;


class Demo extends Common
{
    public function index()
    {
    	$user = new UserModel;
    	dump($user);
    	$list = Db::name('applist')->select();
    	$count = Db::name('applist')->count();
    	$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	return $this->fetch();
    }
    public function save(){
    	$User   = new User; //实例化User对象
        $result = $User->save($data);
        if ($result) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功', 'User/list');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败');
        }
    }
    public function lists()
    {
    	if($this->request->isPost()){
    	$q=$this->request->param('q');
	    $customer = new CustomerModel;
	    $user = new UserModel;
	    $list = $customer->where('qq|weixin|phone','like',$q)->find();
	    $info=['status' => '0','code'=>'002','msg'=>'操作失败','data'=>$list,'q'=>$q];
	    return json($info);
	    }
    }    
    public function addPost()
    {
    	if($this->request->isPost())
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

        
        $del=Db::name('applist')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    	    	       	    
}
