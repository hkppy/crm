<?php
namespace app\api\controller;
use think\Controller;
use think\facade\Session;
use think\facade\Request;
use think\facade\Cache;
use think\facade\Validate;
use think\Db;
use app\facade\Test;
//加载模型
use app\api\model\User as UserModel;
use app\api\model\Customer as CustomerModel;
use app\api\model\CustomerInfo as CustomerInfoModel;
use app\api\model\CustomerExpend as CustomerExpendModel;
use app\api\model\CustomerLogs as CustomerLogsModel;

//加载验证类
use app\api\validate\Customer as CustomerValidate;

class Customer extends Common
{
    protected $beforeActionList = [
        'first',                                //在执行所有方法前都会执行first方法
       // 'second' =>  ['except'=>'hello'],     除hello方法外的方法执行前都要先执行second方法
       // 'three'  =>  ['only'=>'hello,data'],  在hello/data方法执行前先执行three方法
    ];

    protected function first()
    {
        $customer_logs = new  CustomerLogsModel;
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
        
        
        
        $user_logs_list['uid']=session('admin_uid');
        $user_logs_list['userid']=session('admin_uid');
        $user_logs_list['sell_id']=session('admin_uid');
        $user_logs_list['ip']=$this->request->ip();

        //dump($user_logs_list);

        
        
        $result=$customer_logs->insert($user_logs_list);
        

    }
    /**
     * 显示资源列表
     */
    
    public function index()
    {
        $data['version']='1.0.0';
        $data['doc']="http://".request()->host()."/api";
        $this->success('恭喜您,API访问成功!', '',array('data'=>$data));
    }
    public function customer_count_lists()
    {
        
        $customer_expend = new CustomerExpendModel;
        $customer_info=new CustomerInfoModel;
        $customer = new CustomerModel;
        
        //获取今天的新增客户
        $data['today_count']=$customer->whereTime('create_time', 'today')->where(array('status'=>'1','sell_id'=>API_UID))->count();
        // 获取本周的新增客户
        $data['week_count']=$customer->whereTime('create_time', 'week')->where(array('status'=>'1','sell_id'=>API_UID))->count();
        // 获取本月的新增客户
        $data['month_count']=$customer->whereTime('create_time', 'month')->where(array('status'=>'1','sell_id'=>API_UID))->count();
        
        
        //获取今天的新增客户消费金额
        $data['today_count_money']=$customer_expend->whereTime('create_time', 'today')->where(array('status'=>'1','sell_id'=>API_UID))->sum('pay_amount');
        // 获取本周的新增客户消费金额
        $data['week_count_money']=$customer_expend->whereTime('create_time', 'week')->where(array('status'=>'1','sell_id'=>API_UID))->sum('pay_amount');
        // 获取本月的新增客户消费金额
        $data['month_count_money']=$customer_expend->whereTime('create_time', 'month')->where(array('status'=>'1','sell_id'=>API_UID))->sum('pay_amount');

        $this->success('请求成功','',$data);
    
    }   
    
    
    public function lists()
    {
        
        $customer_expend = new CustomerExpendModel;
        $customer_info=new CustomerInfoModel;
        $customer = new CustomerModel;

        $customer_cache='customer_list';
        $customer_list2=cache($customer_cache);

        if(!$customer_list2){

        $list = $customer->where(array('status'=>'1','sell_id'=>API_UID))->select();
        
            foreach($list as $key=>$value){
            $list[$key]['birthday']=$customer_info->where('cid',$value['id'])->value('birthday');
            $list[$key]['address']=$customer_info->where('cid',$value['id'])->value('address');
            $list[$key]['lifa']=$customer_info->where('cid',$value['id'])->value('lifa');
            }
            cache($customer_cache,$list);
            $customer_list2=cache($customer_cache);
        }

        if($customer_list2) {

            $this->success('请求成功', '',$customer_list2);
        } else {
            $this->error('请求失败');
        }
    }

    
    public function add_post()
    {
        
        
        $customer = new Customer2Model;
        $customer_info = new CustomerInfoModel;
        
        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('add_post')->check($data)) {
            $this->error($validate->getError());
        }

        $customer->add($data);
            
        $cid=$list->id;
        if($list){

            $list2 =$customer_info->create([
                'realname'  =>  $data['realname'],
                'address'  =>  $data['address'],
                'notes'  =>  $data['notes'],
                'lifa'  =>  $data['lifa'],
                'birthday'  =>  $data['birthday'],
                'cid'  =>  $cid,
                'sell_id' =>  session('api_uid'),
                'uid' =>  session('api_uid'),
                
            ]); 
        

            if($list) {

            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('操作成功');
            } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('操作失败');
            }
            
            
            
            
        }else{
            
            $this->error('操作失败');
        }   
    }
    public function edit($id='')
    {
        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('del')->check($data)) {
            $this->error($validate->getError());
        }
        
        $customer = new CustomerModel;
        $id=request()->param('id');
        
        $list=$customer->where(array('id'=> $id,'sell_id'=>session('api_uid')))->find();

        if($list) {
            $list['lxfs2']=$list->getData('lxfs');
            $list['customer_info']=$list->profile;
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('记录不存在');
        }
    
    }    
    
    
    public function edit_post()
    {
        
        $id=request()->param('id');
        $customer_info_id=request()->param('customer_info_id');
        
        $customer = new CustomerModel;
        $customer_info = new CustomerInfoModel;
        
        $validate = new CustomerValidate;
        $data = request()->param();
        
        if (!$validate->scene('edit_post')->check($data)) {
            $this->error($validate->getError());
        }

        $list = $customer->allowField(['realname','lxfs','lxfs_value','password'])->save($_POST, ['id' => $id]);



        if($list){
            $list2 = $customer_info->allowField(['realname','address','notes','lifa','birthday'])->save($_POST, ['id' => $customer_info_id]);

            //dump($list2);

            if($list) {

            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('操作成功');
            } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('操作失败');
            }
        }else{
            
             $this->error('操作失败');
        }   
    }
    public function del($id='')
    {
        $customer = new CustomerModel;

        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('del')->check($data)) {
            $this->error($validate->getError());
        }

        $list = $customer->where(array('id'=>$id))->update(array('status'=>'0'));
        
        $group_sid=$list['group_sid'];
        $where=[['sid','in',$group_sid]];
        
        
        if($list) {

            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('操作成功');
        } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('操作失败');
        }
    }    
    
        
}
