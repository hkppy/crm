<?php

namespace app\api\validate;

use think\Validate;

class Shopping extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
    protected $rule =   [
    	'cid'=>'require',
    	'goods_list'=>'require',
		'address_list' => 'require',
        'pay_amount'       => 'require'  
    ];
    
    protected $message  =   [
       	'cid.require'     => '参数错误',
        'goods_list.require'     => '商品信息未选择',
		'address_list.require'     => '收件人信息未填写!',
        'pay_amount.require' => '总金额参数错误!'  
    ];
    
    protected $scene = [
        'add_post'  =>  ['cid','goods_list','address_list','pay_amount'],
    ];
}
