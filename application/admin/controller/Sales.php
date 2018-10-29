<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;
use think\Db;


class Sales extends Common
{

    protected $beforeActionList = [
        'first',
        //'second' =>  ['except'=>'hello'],
        //'three'  =>  ['only'=>'hello,data'],
    ];
    protected function first()
    {
       Debug::remark('begin');
    }
    public function _empty($name)
    {
        echo $name.'这个操作不存在';
    }
    public function _initialize()
    {
        Logs::write(time().'访问'.$_SERVER['PHP_SELF']);
    }

    public function sales_log()
    {
        

        $list = Db::name('customer_logs')->order('id', 'desc')->paginate();
        $count = Db::name('customer_logs')->count();
        $this->assign('count',$count);
    	$this->assign('list',$list);
        Debug::remark('end');
        return $this->fetch();
    }

    public function lists2()
    {

        $customer_logs_cache='customer_logs_list';
        
        $customer_logs_list2=cache($customer_logs_cache);
        
        if(!$customer_logs_list2){

            $list = Db::name('customer_logs')->order('id', 'desc')->limit('300')->select();
            $count = Db::name('customer_logs')->count();
            cache($customer_logs_cache,$list);
            $customer_logs_list2=cache($customer_logs_cache);
            //echo "我是新缓存";
        }   
        
        if($artice_list2) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',array('data'=>$artice_list2));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('请求失败');
        }
        
        
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

        
        $del=Db::name('applist')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    	    	       	    
}
