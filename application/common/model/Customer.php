<?php

namespace app\common\model;

use think\Model;

class Customer extends Model
{
    public function add($data=array()){
    	$data['sell_id']=session('api_uid');
    	$data['uid']=session('api_uid');
    	$this->allowField(true)->save($data);
    	echo $this->id;
    	exit;
    }
}
