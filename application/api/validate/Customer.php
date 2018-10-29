<?php
namespace app\api\validate;

use think\Validate;

class Customer extends Validate
{
    protected $rule =   [
        'id'=>'require',
    	'lxfs'=>'in:1,2,3',
    	'lxfs'=>'require',
		'lxfs_value' => 'require',
        'lifa'       => 'require',
        'birthday'=>'date',
        'aid'=>'require',
        'title'=>'require',
        'content'=>'require',
    ];
    
    protected $message  =   [
        'lxfs.in'     => '联系方式未选择',
        'lxfs.require'     => '联系方式未选择',
		'lxfs_value.require'     => '联系号码未填写!',
        'lifa.require' => '生日历法未填写!',
        'birthday.date' => '出生日期填写不正确!',
        'id.require'     => '参数错误',
        'aid.require'     => '文章ID不能为空',
        'title.require'     => '标题不能为空',
        'content.require'     => '回复内容不能为空',
    ];
    //验证场景
    protected $scene = [
        'add_post'  =>  ['lxfs','lxfs_value','lifa','birthday'],
        'edit_post'  =>  ['lxfs','lxfs_value','lifa','birthday'],
        'del'  =>  ['id'],
        'read'  =>  ['id'],
        'aid'  =>  ['aid'],
        'save'  =>  ['aid','title','content'],
    ];

}