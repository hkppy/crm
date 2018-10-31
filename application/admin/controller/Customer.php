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
use app\admin\model\CustomerLogs as CustomerLogsModel;

//加载验证类
use app\admin\validate\Customer as CustomerValidate;

class Customer extends Common
{
    protected $beforeActionList = [
        'first',
    ];

    protected function first()
    {
        Debug::remark('begin');
        $customer_logs=new CustomerLogsModel;
        $customer_logs->customer_logs();
    }

    public function index()
    {
    	$user=new UserModel;
    	$customer=new CustomerModel;
        $customer_info=new CustomerInfoModel;
        $customer_expend=new CustomerExpendModel;
        $validate=new  CustomerValidate;
        $q=$this->request->param('q');

        $map=[];

        if(session('admin_group_id')!='1'){

            $map[]=['uid','=',ADMIN_UID];
        }
        if(!empty($q)){
            $map[]=['nickname|realname|lxfs_value','like',$q];
        }
        $list=$customer->getCustomerList($map,$order = 'id desc','15');
        //dump($list);
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
        $validate=new  CustomerValidate;

        $param = [
           'id'=>'id',
           'lxfs'=>'lxfs',
           'lxfs_value'=>'lxfs_value',       
           'nickname'=>'nickname',
           'realname'=>'realname',
           'password'=>'password',
        ];


        $data=$customer->buildParam($param);

        if (!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
        }

        $list=$customer->add_post($data);


        if($list){
            Cache::pull('customer_list'); 
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }     
    }
    public function edit()
    {
        $customer=new CustomerModel;
        $customer_info=new CustomerInfoModel;
        $customer_expend=new CustomerExpendModel;

    	$id=$this->request->param('id');
    	$list = $customer->get($id)->getData();
    	$this->assign('list',$list);
    	$info=$customer_info->where('cid',$id)->find();		
        $this->assign('info',$info);

    	 //cid客户ID
    	$res = $customer_expend->where(array('cid'=>$id))->paginate();
        $count = $customer_expend->where(array('cid'=>$id))->count();

        foreach ($res as $key=>$value) {
                $res[$key]['cid_name']=$customer_expend->customer_name($value['cid']);
        }

    	$this->assign('id',$id);
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

        $param = [
           'id'=>'id',
           'lxfs'=>'lxfs',
           'lxfs_value'=>'lxfs_value',       
           'nickname'=>'nickname',
           'realname'=>'realname',
           'password'=>'password',
        ];

        $data=$customer->buildParam($param);
        if (!$validate->scene('edit')->check($data)) {
            $this->error($validate->getError());
        }

        $list=$customer->allowField(['lxfs','lxfs_value','nickname','realname','sell_id','uid','password'])->save($data, ['id' => $data['id']]);
    	
    	if($list){
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
        $customer_info=new CustomerInfoModel;
        $id=$this->request->param('id');

        $list=$customer->get($id)->delete();
  
    	if ($list) {

			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    // public function customer_show()
    // {   
    //     $customer_info=new CustomerInfoModel;

    // 	$id=$this->request->param('id');
    //     $list=$customer_info->where('cid',$id)->find();

    //     $this->assign('id',$id);
    // 	$this->assign('list',$list);
    // 	return $this->fetch('customer_show');
    // }
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

        //获取数据
        $param = [
           'realname'=>'realname',
           'lifa'=>'lifa',
           'realname'=>'realname',
           'birthday'=>'birthday',
           'address'=>'address',
           'notes'=>'notes',
        ];

        $data = $customer_info->buildParam($param);

        //验证
        if(empty($id)){
            $this->error('参数错误');
        }
        $res=$customer_info->where('cid',$id)->find();

        if($res){
            $list=$customer_info->allowField(['nickname','realname','lifa','birthday','address','notes'])->save($data,['id'=>$res['id']]);
        }else{

            $data['cid']=$id;
            $data['sell_id']=ADMIN_UID;
            $data['uid']=ADMIN_UID;
            $list=$customer_info->save($data);
        }

    	if ($list) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
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

        $map[]=['is_del','<>','1'];

        $list = $customer_expend->where($map)->order('id', 'desc')->paginate();
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
    	$user=new UserModel;
    	$customer=new CustomerModel;
        $customer_info=new CustomerInfoModel;
        $customer_expend=new CustomerExpendModel;

    	$q=$this->request->param('q');
        $map=[];
        if(session('admin_group_id')!='1'){

            $map[]=['uid','=',ADMIN_UID];
        }

        if(!empty($q)){
            $map[]=['nickname|realname|lxfs_value','like',$q];
        }

        $list = $customer->onlyTrashed()->where($map)->with('profile')->paginate(15);

        $count = $customer->onlyTrashed()->where($map)->count();


         foreach ($list as $key => $value) {

            $list[$key]['customer_info_count']=$customer_expend->where('cid',$value['id'])->count();
            $list[$key]['user_name']=$user->where('id',$value['sell_id'])->value('username');
        }

        
		$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    }
    public function resysle_delete_add()
    {
    	$customer=new CustomerModel;
        $customer_expend=new CustomerExpendModel;

    	$id=$this->request->param('id');


        $list = $customer->restore(['id' => $id]);

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
