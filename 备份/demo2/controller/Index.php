<?php
namespace app\demo\controller;
use think\Controller;
use think\facade\Debug;
use think\Db;

class Index extends Controller
{
	protected $beforeActionList = [
        'first',                                //在执行所有方法前都会执行first方法
       // 'second' =>  ['except'=>'hello'],     除hello方法外的方法执行前都要先执行second方法
       // 'three'  =>  ['only'=>'hello,data'],  在hello/data方法执行前先执行three方法
    ];

    protected function first()
    {
    	Debug::remark('begin');
    	
    }
    public function index()
    {


        echo "DEMO</br>";

    	Debug::remark('end');
    	echo Debug::getRangeTime('begin','end').'s';
        return $this->fetch();
    }

    public function lists()
    {


    	$list=Db::table('crm_user_logs')->select();

    	Debug::remark('end');
		$begin= Debug::getRangeTime('begin','end').'s';

        $this->success('请求成功', '',array('data'=>$list,'begin'=>$begin));

        
    }

}
