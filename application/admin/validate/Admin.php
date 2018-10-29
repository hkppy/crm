<?php

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
     'username'      => 'require|max:25',
     'password'      => 'require|max:25'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'username.require' => '用户名必须',
        'username.max'     => '用户名最多不能超过25个字符', 
        'password.require' => '密码必须',
        'password.max'     => '密码最多不能超过25个字符',
    ];
}
