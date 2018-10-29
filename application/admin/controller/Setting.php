<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;

class Setting extends Common
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
    public function index()
    {
    	
    	$result = Db::name('system')->find();
    	//dump($result);
    	$this->assign('result',$result);
    	return $this->fetch('site');
    }
    public function addPost()
    {
    	//print_r($_GET);//只能获取name值
		//$data = $this->request->param();
        $data['site_name']=$this->request->param('site_name');
        $data['site_seo_keywords']=$this->request->param('site_seo_keywords');
        $data['site_seo_description']=$this->request->param('site_seo_description');
        $data['website_copyright']=$this->request->param('website_copyright');
        $data['site_icp']=$this->request->param('site_icp');
        $data['site_analytics']=$this->request->param('site_analytics');
        
        $res=Db::name('system')->where('id',1)->find();
        
        if(!$res){
        	$list=Db::name('system')->insert($data);
        	$data=['status' => '1','code'=>'001','msg'=>'操作成功','data'=>'',];
        	
        }else{
        	Db::name('system') ->where('id', 1)->update($data);
        	$data=['status' => '1','code'=>'001','msg'=>'更新成功','data'=>'',];
        }
        return json($data);
        
    }
    public function System_log(){

        $list = Db::name('user_logs')->order('id', 'desc')->paginate('15');
        $count = Db::name('user_logs')->count();

        $this->assign('count',$count);
        $this->assign('list',$list);
        Debug::remark('end');
        return $this->fetch();
    }




    public function System_log_del(){
    	$id=$this->request->param('id');
        
        $del=Db::name('user_logs')->where('id',$id)->delete();
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    
           
}
