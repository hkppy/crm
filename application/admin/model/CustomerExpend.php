<?php

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;
class CustomerExpend extends Model
{
	    use SoftDelete;
	protected $table = 'crm_customer_expend';
	protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;
    //获取客户真实姓名
    public function customer_name($value)
    {
 		return $value = Customer::where('id',$value)->value('realname');
    }
}
