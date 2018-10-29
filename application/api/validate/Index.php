<?php
namespace app\api\validate;

use think\Validate;

class Index extends Validate
{
    protected $rule =   [
        'q'      => 'require|max:32',
    ];
    
    protected $message  =   [
        'q.require' => '关键字必须',
        'q.max'     => '关键字最多不能超过32个字符', 
    ];
    //验证场景
    protected $scene = [
        'edit'  =>  ['name','age'],
    ];
    // edit 验证场景定义
    public function sceneSearch()
    {
    	return $this->only(['q']);
    } 
}