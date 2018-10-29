<?php

namespace app\common\validate;

use think\Validate;

class ArticleCategory extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */ 
    protected $rule = [
      'name'  => 'require|max:25',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */ 
    protected $message = [
      'name.require' => '名称必须',
      'name.max'     => '名称最多不能超过25个字符',
    ];
}
