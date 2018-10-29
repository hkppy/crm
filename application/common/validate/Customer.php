<?php

namespace app\common\validate;

use think\Validate;

class Customer extends Validate
{
    protected $rule =   [
        'id'  => 'require',
        'name'  => 'require|max:25',
        'title'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',   
        'realname'  => 'require|max:25|token',
        'qq'  => 'require|max:25', 
        'weixin'  => 'require|max:25', 
        'url'  => 'require',
        'username'  => 'require|max:32',
        'password'  => 'require|max:32',
        'aid'  => 'require',
    ];
    
    protected $message  =   [
        'id.require' => '参数错误',
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'title.require' => '标题必须', 
        'title.max'     => '标题最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',
        'realname.require' => '姓名必须',
        'realname.max'     => '姓名最多不能超过25个字符',    
        'realname.token'     => '请勿重复提交数据',    
        'qq.require' => 'qq必须',
        'q.max'     => 'qq最多不能超过25个字符',    
        'weixin.require' => '微信必须',
        'weixin.max'     => '微信最多不能超过25个字符', 
        'weixin.require' => '接口地址必须',
        'username.require' => '用户名不能为空',
        'username.max'     => '用户名最多不能超过32个字符',    
        'password.require' => '密码不能为空',
        'password.max'     => '密码最多不能超过32个字符',
        'aid.require' => '文章ID不能为空',    
    ];

    protected $scene = [
        'edit'  =>  ['realname','qq','weixin'],
        'add'  =>  ['realname','qq','weixin'],
        'check_id'  =>  ['id'],
        'check_aid'  =>  ['aid'],
        'api_edit'  =>  ['id'],
        'api_id'  =>  ['id'],
        'api_update'  =>  ['title','url'],
        'api_user_login'  =>  ['username','password'],
    ];
}
