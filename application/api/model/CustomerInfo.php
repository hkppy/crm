<?php
namespace app\api\model;
use think\Model;

class CustomerInfo extends Model
{
	
	
	protected $table = 'crm_customer_info';
	
	protected $autoWriteTimestamp = true;
	protected $insert = ['status' => 1];  
	
	protected $type = [
        'birthday'  =>  'timestamp'
	];

	public function getLifaAttr($value)
    {
        $status = ['1'=>'农历','2'=>'阳历'];
        return $status[$value];
    } 

        
}
