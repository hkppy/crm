<?php

namespace app\admin\model;

use think\Model;

class SellerContact extends Model
{
    protected $table = 'crm_seller_contact';
    public function getTypeAttr($value)
    {
        $status = ['0'=>'未填写','1'=>'微信','2'=>'QQ'];
        return $status[$value];
    } 
}
