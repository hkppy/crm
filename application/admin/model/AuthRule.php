<?php

namespace app\admin\model;

use think\Model;

class AuthRule extends Model
{
    //
    protected $table = 'crm_auth_rule';

    public function get_pid_cate($value)
    {
        if($value=='0'){
        	return $value="顶级分类";
        }else{
        	return $value = $this->where('id',$value)->value('name');
        }
    }
}
