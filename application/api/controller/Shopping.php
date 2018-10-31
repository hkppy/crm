<?php
namespace app\api\controller;
use think\Controller;
use think\Validate;
use think\facade\Cache;
use app\api\model\Customer as CustomerModel;
use app\api\model\CustomerInfo as CustomerInfoModel;
use app\api\model\CustomerExpend as CustomerExpendModel;

//加载验证类
use app\api\validate\Customer as CustomerValidate;

class Shopping extends Common
{
    /**
     * 显示资源列表
     */
    public function shopping_count_lists()
    {
    	
    	$customer_expend = new CustomerExpendModel;
		$customer_info=new CustomerInfoModel;
		$customer = new CustomerModel;
    	
        $data_count_list=cache('shop_count_list_cache');

        if(!$data_count_list){
            //获取今天的新增
        $data_count['today_count']=$customer_expend->whereTime('create_time', 'today')->where(array('status'=>'1','sell_id'=>API_UID))->count();
        // 获取本周的新增
        $data_count['week_count']=$customer_expend->whereTime('create_time', 'week')->where(array('status'=>'1','sell_id'=>API_UID))->count();
        // 获取本月的新增
        $data_count['month_count']=$customer_expend->whereTime('create_time', 'month')->where(array('status'=>'1','sell_id'=>API_UID))->count();
        
        
        //获取今天的新增
        $data_count['today_count_money']=$customer_expend->whereTime('create_time', 'today')->where(array('status'=>'1','sell_id'=>API_UID))->sum('pay_amount');
        // 获取本周的新增
        $data_count['week_count_money']=$customer_expend->whereTime('create_time', 'week')->where(array('status'=>'1','sell_id'=>API_UID))->sum('pay_amount');
        // 获取本月的新增
        $data_count['month_count_money']=$customer_expend->whereTime('create_time', 'month')->where(array('status'=>'1','sell_id'=>API_UID))->sum('pay_amount');

        Cache::set('shop_count_list_cache',$data_count);

        $data_count_list=cache('shop_count_list_cache');
        }

    	$this->success('请求成功', '',$data_count_list);
    
	}	
    public function index()
    {
    	
		$customer_expend = new CustomerExpendModel;
		$customer_info=new CustomerInfoModel;
		$customer = new CustomerModel;

        $shopping_cache='shopping_list';
        
        $shopping_list2=cache($shopping_cache);
        
		if(!$shopping_list2){

		$shopping_list=$customer_expend->order('id', 'desc')->where(array('status'=>'1','sell_id'=>API_UID))->paginate(20);

	
		foreach($shopping_list as $key=>$value){
			$shopping_list[$key]['lxfs']=$customer->where('id',$value['cid'])->value('lxfs');	
		  	$shopping_list[$key]['lxfs_value']=$customer->where('id',$value['cid'])->value('lxfs_value');
		  	$shopping_list[$key]['realname']=$customer_info->where('cid',$value['cid'])->value('realname');
		}
            cache($shopping_cache,$shopping_list);
            $shopping_list2=cache($shopping_cache);

        }  		
    	if($shopping_list2) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',$shopping_list2);
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('请求失败');
        }

	}
	public function lists()
    {
    	
    	$customer = new CustomerModel;
        $customer_expend = new CustomerExpendModel;
        $customer_info=new CustomerInfoModel;

    	
         $shopping_cache='shopping_list';
        
        $shopping_list2=cache($shopping_cache);

        if(!$shopping_list2){

        $shopping_list=$customer_expend->order('id', 'desc')->where(array('status'=>'1','sell_id'=>API_UID))->paginate(20);
        

    
        foreach($shopping_list as $key=>$value){
            $shopping_list[$key]['lxfs']=$customer->where('id',$value['cid'])->value('lxfs');   
            $shopping_list[$key]['lxfs_value']=$customer->where('id',$value['cid'])->value('lxfs_value');
            $shopping_list[$key]['realname']=$customer_info->where('cid',$value['cid'])->value('realname');
        }
            cache($shopping_cache,$shopping_list);
            $shopping_list2=cache($shopping_cache);

        }       
        if($shopping_list2) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',$shopping_list2);
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('请求失败');
        }

    }

    public function add_post()
    {
    	
    	
		$customer = new CustomerModel;
		$customer_info = new CustomerInfoModel;
		$customer_expend = new CustomerExpendModel;
		
		$validate = new \app\api\validate\Shopping;

		$data = request()->param();
        
        if (!$validate->scene('add_post')->check($data)) {
            $this->error($validate->getError());
        }


		$list = $customer_expend->create([
			    'goods_list' =>  $data['goods_list'],
			    'address_list' =>  $data['address_list'],
			    'goods' =>  $data['goods_list'],
			    'expinfo' =>  $data['address_list'],
			    'pay_amount' =>  $data['pay_amount'],
			    'cid' =>  $data['cid'],
			    'sell_id' =>  session('api_uid'),
			    'uid' =>  session('api_uid')
				]);
		
		if($list) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('操作成功', '',array('data'=>''));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('参数错误');
        }

    }

    public function edit($id='')
    {

        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('del')->check($data)) {
            $this->error($validate->getError());
        }
        $customer_expend = new CustomerExpendModel;

        $list=$customer_expend->where(array('id'=> $id,'sell_id'=>session('api_uid')))->find();

        if($list) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',array('data'=>$list));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('记录不存在');
        }
    }
    
    public function edit_post(){
        
    }

    public function more(){
    	$id=request()->id;
    	$customer_info = new CustomerInfoModel;
    	$realame=$customer_info->where('cid',$id)->value('realname');
    	
    	if($realame) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('操作成功', '',array('data'=>$realame));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('参数错误');
        }
    }
    
}
