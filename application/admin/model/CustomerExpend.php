<?php

namespace app\admin\model;

use think\Model;

class CustomerExpend extends Model
{
	
	protected $table = 'crm_customer_expend';
    protected $autoWriteTimestamp = true;
    //获取客户真实姓名
    public function customer_name($value)
    {
 		return $value = Customer::where('id',$value)->value('realname');
    }
}
