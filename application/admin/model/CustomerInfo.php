<?php

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;
class CustomerInfo extends Model
{
    use SoftDelete;	
    protected $autoWriteTimestamp = true;
    
    protected $type = [
        'status'    =>  'integer',
        'score'     =>  'float',
        'birthday'  =>  'timestamp',
    ];
    protected $table = 'crm_customer_info';
    protected $deleteTime = 'delete_time';
    public function buildParam($array)
    {
        $data=[];
        if (is_array($array)){
            foreach( $array as $item=>$value ){
                $data[$item] = request()->param($value);
            }
        }
        return $data;
    }
}
