<?php

namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule =   [
        'id'  => 'require',
        'name'  => 'require|max:25',
        'title'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',    
        'content'  => 'require',
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
        'content'        => '内容不能为空',    
    ];
    
    protected $scene = [
        'edit'  =>  ['name','age'],
        'add'  =>  ['name','age'],
        'check_id'  =>  ['id'],
        'article_add'  =>  ['title','content'],
        'article_edit'  =>  ['title','content'],
    ];
    
}
