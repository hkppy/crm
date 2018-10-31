<?php

namespace app\admin\validate;

use think\Validate;

class Customer extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */ 
    protected $rule = [
     'lxfs'      => 'require|max:25',
     'lxfs_value'      => 'require|max:25',
     'nickname'      => 'require|max:25',
     'realname'      => 'require|max:25',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */ 
    protected $message = [
        'lxfs.require' => '联系名称必须',
        'lxfs.max'     => '联系名称必须最多不能超过25个字符', 
        'lxfs_value.require' => '联系方式必须',
        'lxfs_value.max'     => '联系方式必须最多不能超过25个字符',        
        'nickname.require' => '昵称必须',
        'nickname.max'     => '昵称最多不能超过25个字符', 
        'realname.require' => '姓名必须',
        'realname.max'     => '姓名最多不能超过25个字符',
    ];
    
    protected $scene = [
        'add'  =>  ['lxfs','lxfs_value'],
        'edit'  =>  ['lxfs','lxfs_value'],
    ];
}
