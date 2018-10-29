<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

//加载Facade类
use think\facade\Session;
use think\facade\Request;
use think\facade\Cache;
use think\facade\Validate;
use think\facade\Debug;
use think\facade\Url;

//加载模型
use app\admin\model\User as UserModel;
use app\admin\model\Goods as GoodsModel;
use app\admin\model\Apilist as ApilistModel;
use app\admin\model\Article as ArticleModel;
use app\admin\model\Customer as CustomerModel;
use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\model\SellerLevel as SellerLevelModel;
use app\admin\model\SellerGroup as SellerGroupModel;
use app\admin\model\CustomerInfo as CustomerInfoModel;
use app\admin\model\SellerContact as SellerContactModel;
use app\admin\model\CustomerExpend as CustomerExpendModel;
use app\admin\model\ArticleCategory as ArticleCategoryModel;


//加载验证类
use app\common\validate\Customer as CustomerValidate;

class Customer extends Common
{
    protected $beforeActionList = [
        'first',
    ];

    protected function first()
    {
        Debug::remark('begin');

    	$user_logs_m=$this->request->module();
		$user_logs_c=$this->request->controller();
		$user_logs_a=$this->request->action(); 

		$role_auth_action=strtolower($user_logs_m."/".$user_logs_c."/".$user_logs_a);

		$user_logs_list['action']=$role_auth_action;
    	$user_logs_list['add_time']=time();
    	$user_logs_list['time']=time();
    	
    	switch ($user_logs_a)
		{
		case 'index':
		  $user_logs_list['note']="操作index页面";
		  break;  
		case 'add':
		   $user_logs_list['note']="进入新增页面";
		  break;
		case 'addPost':
		   $user_logs_list['note']="进入新增添加操作";
		   
		  break;		  
		case 'edit':
		   $user_logs_list['note']="进入修改页面";
		  break;		
		case 'delete':
		   $user_logs_list['note']="进入删除页面";
		  break;		  
		case 'recycle':
		   $user_logs_list['note']="进入回收站操作页面";
		  break;
		case 'shop_list':
		   $user_logs_list['note']="进入客户消费信息页面";
		  break;		  		    
		default:
		  $user_logs_list['note']="未定义";
		}


    	$user_logs_list['uid']=ADMIN_UID;
		$user_logs_list['userid']=ADMIN_UID;
        $user_logs_list['userid']=ADMIN_USERNAME;
		$user_logs_list['sell_id']=ADMIN_UID;
		$user_logs_list['ip']=$this->request->ip();
		
		
		$result=Db::name('customer_logs')->insert($user_logs_list);
    	

    }

    public function index()
    {
    	
    	$customer=new CustomerModel;
        $customer_info=new CustomerInfoModel;
        $customer_expend=new CustomerExpendModel;

        $validate=new  CustomerValidate;

    	$q=$this->request->param('q');


        $map[]=['is_del','<>','1'];

        if(session('admin_group_id')!='1'){

            $map[]=['uid','=',ADMIN_UID];
        }

        if(!empty($q)){

            $map[]=['realname|qq|weixin|phone','like',$q];
        }


        $list = $customer->where($map)->order('id', 'desc')->paginate(15);
        $count =$customer->where($map)->count();

        foreach ($list as $key => $value) {

            $list[$key]['customer_info_count']=$customer_expend->where('cid',$value['id'])->count();
            $list[$key]['user_name']=$list[$key]->profile1->username;
            $list[$key]['realname1']=$list[$key]->profile2->realname;
            $list[$key]['address']=$list[$key]->profile2->address;

        }
        //dump($list);

		$this->assign('count',$count);
    	$this->assign('list',$list);
        Debug::remark('end');
    	return $this->fetch();
    }
    public function add()
    {
    	return $this->fetch('add');
    }
  
    public function addPost()
    {

        $customer=new CustomerModel;
        $customer_info=new CustomerInfoModel;
        $customer_expend=new CustomerExpendModel;
        $validate=new  CustomerValidate;

        $data = request()->param();
        if (!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
        }

        $data['qq']=$this->request->param('qq');
        $data['realname']=$this->request->param('realname');
        $data['weixin']=$this->request->param('weixin');
        $data['phone']=$this->request->param('phone');

        $data['sell_id']=ADMIN_UID;
        $data['uid']=ADMIN_UID;

        if(!empty($password)){
            $data['password']=md5($password);
        }
        $list=$customer->save($data);

        if($list){

            $data2['cid']=$customer->id;
            $data2['realname']=$data['realname'];
            $data2['sell_id']=ADMIN_UID;
            $data2['uid']=ADMIN_UID;
            $list2=$customer_info->save($data2);

            if($list2){
                Cache::pull('customer_list'); 
                $this->success('操作成功', '',array('data'=>''));
                } else {
                    
                    $this->error('操作失败');
                }

        }else {
                
                $this->error('操作失败');
        }



        
    }
    public function edit()
    {
        $customer=new CustomerModel;
        $customer_info=new CustomerInfoModel;
        $customer_expend=new CustomerExpendModel;

    	$id=$this->request->param('id');

    	$list = $customer->get($id);

    	$this->assign('list',$list);

    	$info=$customer_info->where('cid',$id)->find();		

        $this->assign('info',$info);


    	 //cid客户ID
    	$res = $customer_expend->where(array('cid'=>$id))->paginate(15);
        $count = $customer_expend->where(array('cid'=>$id))->count();

        foreach ($res as $key=>$value) {
                $res[$key]['cid_name']=$customer_expend->customer_name($value['cid']);
        }
    	$this->assign('cid',$id);
    	$this->assign('count',$count);
		$this->assign('res',$res);
		
		return $this->fetch('edit');
    }      
    public function editPost()
    {



        $customer=new CustomerModel;
        $customer_info=new CustomerInfoModel;
        $customer_expend=new CustomerExpendModel;
        $validate=new  CustomerValidate;

        $data = request()->param();
        if (!$validate->scene('edit')->check($data)) {
            $this->error($validate->getError());
        }

        $id=$this->request->param('id');
        $data['realname']=$this->request->param('realname');
        $data['qq']=$this->request->param('qq');
        $data['phone']=$this->request->param('phone');
        $data['weixin']=$this->request->param('weixin');
        $password=$this->request->param('password');

    	if(!empty($password)){
    		$is_data['password']=md5($password);
    		$result = $customer->save($data,['id' => $id]);
    	}else{
    		$result = $customer->save($data,['id' => $id]);
    	}
    	
    	if($result){
                Cache::pull('customer_list'); 
                $this->success('操作成功', '',array('data'=>''));
            } else {
                        
                $this->error('操作失败');
            }
    	
    }	    
    public function delete()
    {
    	$customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;
    	$id=$this->request->param('id');

        if(session('admin_group_id')=='1'){
    		$list=$customer->where('id',$id)->update(array('is_del'=>'1'));
    	}else{
    		$list=$customer->where('id',$id)->update(array('is_del'=>'1'));
    	}
    	
			$customer_expend->where('cid',$id)->update(array('is_del'=>'1'));
    	
        
    	if ($list) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function customer_show()
    {
    	$cid=$this->request->param('id');
    	$list=Db::name('customer_info')->where('cid',$cid)->find();

    	$this->assign('cid',$cid);
    	$this->assign('list',$list);
    	return $this->fetch('customer_show');
    }
    public function shop_add()
    {
    	$customer=new CustomerModel;
    	
    	$cid=$this->request->param('cid');
    	
    	if(!empty($cid)){
    		$res2=$customer->where(array('id'=>$cid,'status'=>'1'))->find();
    		$this->assign('res2',$res2);
    	}
    	if(session('admin_group_id')=='1'){
    		$res=$customer->select();
    	}else{
    		$res=$customer->where(array('uid'=>ADMIN_UID))->select();
    	}
    	
    	
		$this->assign('cid',$cid);
		$this->assign('res',$res);
    	return $this->fetch('show_add');
    }
    public function customer_show_Post()
    {
        $customer_info=new CustomerInfoModel;
    	$id=$this->request->param('id');

    	$cid=$this->request->param('cid');

    	$list=Db::name('customer_info')->where('cid',$cid)->find();

    	
    	if($list){

    		$update_data['realname']=$this->request->param('realname');
    		$update_data['lifa']=$this->request->param('lifa');
    		$update_data['birthday']=strtotime($this->request->param('birthday'));
    		$update_data['address']=$this->request->param('address');
    		$update_data['notes']=$this->request->param('notes');

    		$result = $customer_info->where(array('id'=>$id))->update($update_data);
    		if ($result) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'更新成功'];
	        } else {
	            $info=['status' => '0','code'=>'002','msg'=>'更新失败'];
	        }
	        return json($info);
    	}else{
    		
    		$insert_data['lifa']=$this->request->param('lifa');
    		$insert_data['birthday']=strtotime($this->request->param('birthday'));
    		$insert_data['address']=$this->request->param('address');
    		$insert_data['notes']=$this->request->param('notes');
    		$insert_data['cid']=$cid;
    		$insert_data['sell_id']=ADMIN_UID;
    		$insert_data['uid']=ADMIN_UID;
    		
    		$insert_data['add_time']=time();
    		//dump($insert_data);
    		
    		$list=$customer_info->insert($insert_data);
    		if ($list) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
	        } else {
	            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
	        }
	        return json($info);
    	}

    }    
    public function shop_list()
    {
    	$id=$this->request->param('id');

        $customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;

        $sell_id=intval(ADMIN_UID);

        $map=array();

        if(session('admin_group_id')!='1'){
            $map[]=['sell_id','=',session('admin_uid')];
        }
        if(!empty($id)&&$id!=''){
            $map[]=['cid','=',$id];
        }

        $list = $customer_expend->where($map)->order('id', 'desc')->paginate(15);
        $count = $customer_expend->where($map)->count();

        foreach ($list as $key=>$value) {

                $list[$key]['cid_name']=$customer_expend->customer_name($value['cid']);
            }
    	
    	if(!empty($id)){
    		$this->assign('cid',$id);
    	}
    	
        //dump($list);
		$this->assign('count',$count);
    	$this->assign('list',$list);
        Debug::remark('end');
    	return $this->fetch('shop_list');
    }
    public function sales_show()
    {
        $user=new UserModel;
        $customer=new CustomerModel;
    	$id=$this->request->param('id');
    	$list=$customer->where('id',$id)->find();
    	
    	$res=$user->where('id',$list['sell_id'])->find();
    	
    	$list['sell_name']=$res['user_nickname'];
    	$this->assign('list',$list);
    	return $this->fetch('sales_show');
    }
    public function search_sell_id(){
    	$user=new UserModel;
    	$q=$this->request->param('q');
    	$list=$user->where('user_login|user_nickname|id','like',$q."%")->where(array('user_type'=>'2'))->find();
    	if ($list) {
    		$info=['status' => '1','code'=>'002','msg'=>'查询成功','data'=>$list];
	    }else{
	        $info=['status' => '0','code'=>'002','msg'=>'查询失败'];
	    }

    	return json($info);
    	
    }
    
    
    public function shop_addPost(){

        $customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;


    	if($this->request->isPost()){
		$insert_data['pay_amount']=$this->request->param('pay_amount');
    	
    	$address_list=$this->request->param('address_list/a');
    	
    	if(count($address_list)<'1'){
    		$info=['status' => '0','code'=>'002','msg'=>'你需要先选择一个收货地址才能提交！'];
    		return json($info);
    		exit;
    	}
    	
    	
    	
        $address_list2 = implode(",",$address_list) ;
        

		
		$insert_data['address_list']=$address_list2;
		
		$goods_list=$this->request->param('goods_list/a');
		
		
		if(count($goods_list)<'1'){
    		$info=['status' => '0','code'=>'002','msg'=>'你最少需要选择一个商品才能提交！'];
    		return json($info);
    		exit;
    	}
		
		//$goods_list2 = json_decode($goods_list) ;
		$goods_list2 = implode("-",$goods_list);
		$insert_data['goods_list']=$goods_list2;
		
		
		
	    
    	$insert_data['cid']=$this->request->param('cid');
    	$insert_data['uid']=ADMIN_UID;
    	$insert_data['sell_id']=ADMIN_UID;
		$insert_data['add_time']=time();
    	
    	$list=$customer_expend->save($insert_data);
    	//$list=true;
    	
    	if ($list) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功','data'=>$insert_data];
	    }else{
	        $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
	    }
    	return json($info);
    	}
    }

    public function shop_list_delete()
    {
    	$customer_expend=new CustomerExpendModel;
    	$id=$this->request->param('id');

        if(session('admin_group_id')=='1'){
    		$list=$customer_expend->where('id',$id)->update(array('is_del'=>'1'));
    	}else{
    		$list=$customer_expend->where('id',$id)->update(array('is_del'=>'1'));
    	}
        
    	if ($list) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function customer_shop_edit(){
        $customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;
		//客户ID
    	$id=$this->request->param('id');
    	
    	if(session('admin_group_id')=='1'){
    		$res=$customer->select();
    	}else{
    		$res=$customer->where(array('uid'=>ADMIN_UID))->select();
    	}
    	
    	$this->assign('res',$res);
    	$list = $customer_expend->where(array('id'=>$id))->find();
    	
    	$list2 = explode("-", $list['goods_list']);
    	
    	
    	 //dump($list);
    	$this->assign('list2',$list2);
    	$this->assign('list',$list);
    	return $this->fetch('customer_shop_edit');
    	
    	
    }
    public function customer_shop_edit_post(){
        $customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;
    	$id=$this->request->param('id');
    	
    	$insert_data['pay_amount']=$this->request->param('pay_amount');
    	
    	$address_list=$this->request->param('address_list/a');
    	
    	
    	if(count($address_list)<'1'){
    		$info=['status' => '0','code'=>'002','msg'=>'你需要先选择一个收货地址才能提交！'];
    		return json($info);
    		exit;
    	}
    	
    	
        $address_list2 = implode(",",$address_list) ;
        
        $insert_data['address_list']=$address_list2;
		
		$goods_list=$this->request->param('goods_list/a');
		
		
		if(count($goods_list)<'1'){
    		$info=['status' => '0','code'=>'002','msg'=>'你最少需要选择一个商品才能提交！'];
    		return json($info);
    		exit;
    	}

		//$goods_list2 = json_decode($goods_list) ;
		$goods_list2 = implode("-",$goods_list);
		$insert_data['goods_list']=$goods_list2;

    	$list=$customer_expend->where('id',$id)->update($insert_data);
    	//$list=true;
    	
    	if ($list) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功','data'=>$insert_data];
	    }else{
	        $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
	    }
    	return json($info);
    }
    public function  recycle()
    {
    	
    	$customer=new CustomerModel;
    	$q=$this->request->param('q');


        $map[]=['is_del','=','1'];

        if(session('admin_group_id')!='1'){

            $map[]=['uid','=',ADMIN_UID];
        }

        if(!empty($q)){

            $map[]=['realname|qq|weixin|phone','like',$q];
        }

        $list = $customer->where($map)->paginate(15);
        $count = $customer->where($map)->count();


        foreach ($list as $key => $value) {
            $list[$key]['user_name']=$list[$key]->profile1->username;
            $list[$key]['realname1']=$list[$key]->profile2->realname;
            $list[$key]['address']=$list[$key]->profile2->address;
        }
		//dump($list);
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function resysle_delete_add()
    {
    	$customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;
    	$id=$this->request->param('id');

        if(session('admin_group_id')=='1'){
    		$list=$customer->where('id',$id)->update(array('is_del'=>'0'));
    	}else{
    		$list=$customer->where('id',$id)->update(array('is_del'=>'0'));
    	}
        
        	$customer_expend->where('cid',$id)->update(array('is_del'=>'0'));
        
    	if ($list) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    
    public function shop_list_del()
    {
        $customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;
    	//查看删除的消费信息
    	$id=$this->request->param('id');
    	$list = $customer_expend->where(array('cid'=>$id))->where('is_del','=','1')->select();
    	$count = $customer_expend->where(array('cid'=>$id))->where('is_del','=','1')->count();
		foreach ($list as $key=>$value) {
			$role_list[$key] = $customer->where(array('id'=>$value['cid']))->field('realname')->find();
			$list[$key]['cid_name']=$role_list[$key]['realname'];
		}    	
    	
    	$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    }	    
    public function customer_list()
    {
        $customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;
    	$id=$this->request->param('id');
    	$list = $customer->where(array('sell_id'=>$id))->where('is_del','<>','1')->select();
    	$count = $customer->where(array('sell_id'=>$id))->where('is_del','<>','1')->count();
    	foreach ($list as $key=>$value) {
			$role_list[$key] = Db::name('user')->where(array('id'=>$value['sell_id']))->field('user_login')->find();
			$list[$key]['sell_name']=$role_list[$key]['user_login'];
		}
    	$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    	
    }	    
}
