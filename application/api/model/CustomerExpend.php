<?php
namespace app\api\model;
use think\Model;

class CustomerExpend extends Model
{
	
	protected $insert = ['status' => '1'];  
	protected $table = 'crm_customer_expend';
	protected $autoWriteTimestamp = true;
	protected $json = ['goods_list','address_list','expinfo','goods'];
    
 
}
