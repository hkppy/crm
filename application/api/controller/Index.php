<?php
namespace app\api\controller;
use think\Controller;
use think\facade\Session;
use think\facade\Request;
use think\facade\Cache;
use	think\facade\Validate;

use app\api\model\User as UserModel;
use app\api\model\Customer as CustomerModel;
use app\api\model\SellerContact as SellerContactModel;
use app\api\model\SellerGroup as SellerGroupModel;
use app\api\validate\Index as IndexValidate;



class Index extends Controller
{   
	
	public function index()
    {

		$data['version']='1.0.0';
		$data['doc']="http://".request()->host()."/api";
		$this->success('恭喜您,API访问成功!', '',array('data'=>$data));
	}	
    
    //客户信息搜索
    public function search($q='')
    {

    	$data['q']=$q;
		
		$customer = new CustomerModel;

		$validate = new IndexValidate;

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        } 
		$list = $customer->where('qq|weixin|phone','like',$q)->cache('120')->find();

	    
	    if($list){
	    		    
	    	$sell_id=$list->sell_id;

	    	$user2 =$user->where('id',$sell_id)->cache('120')->value('username');
	    	$msg="这是位老客户，请转给".$user2."销售！";
	    	$info=['status' => '1','code'=>'002','msg'=>$msg];
	    }else{
	    	$info=['status' => '1','code'=>'002','msg'=>'这是位新客户,请好好把握！'];
	    }
	    return json($info);
	
    }	
	//大师列表轮训
    public function lists(Request $request)
    {
    	//分组ID
		$customer = new CustomerModel;
	    $user = new UserModel;
	    $seller_contact=new SellerContactModel;
	    
	    $dashi_cache='dashi_list';
	    
	    $point_cache='ds_point';
	    
	    $seller_group=new SellerGroupModel;
	    $group_id=$this->request->param('id');

	    $seller_group_list=$seller_group->get($group_id);

	    if(!empty($group_id)&&!$seller_group_list){

	    	$this->error('分组不存在');


	    }
	    
	   	if(!empty($seller_group_list['group_sid']&&!empty($group_id))){
	    	$this->error('此分组下没有数据');
	    }

		//echo $seller_group_list['group_sid'];
    	
    	if($seller_group_list){
    		$where=[['sid','in',$seller_group_list['group_sid']]];

    		$dashi_cache.="_".$seller_group_list['id'];
	    	$point_cache.="_".$seller_group_list['id'];
	    }else{
	    	$where='';
	    }

	    $dashi = Cache::get($dashi_cache);
		$point = (int)\Cache::get($point_cache);
	    
		if(!$dashi){
			
	    	$wqlist5=$seller_contact->div_seller_contact_list($where);
		    //设置缓存
		    cache($dashi_cache,$wqlist5);
		    $dashi=cache($dashi_cache);
			$point = 0;
		}
		//dump($point);
	    //dump(($dashi));

		$curdashi=$dashi[$point];
		
		$point = $point+1 >= count($dashi) ? 0 : $point+1;
		Cache::set($point_cache,$point);
		
		//dump($curdashi);

		$this->success('请求成功', '', $curdashi);
		return json($info);

    }
    //大师分组列表轮训
    public function group_lists(Request $request)
    {
    	$customer = new CustomerModel;
	    $user = new UserModel;
	    $seller_contact=new SellerContactModel;
	    
    	$seller_group=new SellerGroupModel;
    	
    	
    	$group_id=$this->request->param('id');
    	
    	$list=$seller_group->get($group_id);
    	
    	$where=[['sid','in',$list['group_sid']]];
    	
    	$wqlist5=$seller_contact->div_seller_contact_list($where);
    	
    	dump($wqlist5);
     	
    }    
    	
}
