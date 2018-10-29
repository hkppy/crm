<?php

namespace app\admin\model;

use think\Model;

class Customer extends Model
{
    protected $autoWriteTimestamp = true;
    public function getLxfsAttr($value)
    {
        $status = [0=>'未填写',1=>'微信',2=>'QQ',3=>'手机号'];
        return $status[$value];
    }
    public function profile1()
    {
        return $this->hasOne('user','id','sell_id');
    }
    public function profile2()
    {
        return $this->hasOne('customer_info','cid');
    }
}
