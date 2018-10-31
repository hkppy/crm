<?php
namespace app\admin\model;
use think\Model;

class CustomerLogs extends Model
{
    protected $table = 'crm_customer_logs';
    public function customer_logs(){

    	$user_logs_m=request()->module();
		$user_logs_c=request()->controller();
		$user_logs_a=request()->action(); 

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
        $user_logs_list['username']=ADMIN_USERNAME;
		$user_logs_list['sell_id']=ADMIN_UID;
		$user_logs_list['ip']=request()->ip();
		$result=$this->insert($user_logs_list);
    }
}
