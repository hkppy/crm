<?php
namespace app\admin\model;
use think\Model;

class User extends Model
{
    protected $auto = ['username','ip'];
    protected $insert = ['status' =>'1'];  
    protected $update = ['ip','login_ip'];  
    protected $autoWriteTimestamp = true;
    protected $type = [
        'status'    =>  'integer',
        'score'     =>  'float',
        'birthday'  =>  'datetime',
    ];



    
    //protected $readonly = ['username', 'email'];
    protected function setUsernameAttr($value)
    {
        return strtolower($value);
    }

    protected function setIpAttr()
    {
        return request()->ip();
    }
 
}