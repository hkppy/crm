<?php
namespace app\api\model;
use think\Model;


class Customer extends Model
{

    protected $deleteTime = 'delete_time';
	protected $autoWriteTimestamp = true;
	protected $insert = ['status' => '1'];  

    public function profile()
    {
        return $this->hasOne('customer_info','cid');
    }
    public function comments()
    {
        return $this->hasMany('customer_expend','cid');
    }    
 
    public function getTypeAttr($value)
    {
        $status = ['1'=>'微信','2'=>'QQ'];
        return $status[$value];
    }     
     public function getLifa($value)
    {
        $status = ['1'=>'农历','2'=>'阳历'];
        return $status[$value];
    }         
}
