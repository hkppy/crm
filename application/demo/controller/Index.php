<?php
namespace app\demo\controller;
use think\Controller;
use think\facade\Request;
use app\demo\model\Members as MembersModel;
class Index extends Controller
{
    public function index()
    {

        	$members= new MembersModel;

        	$list=$members->all('1,2,3');
        	dump($list);

        	if($this->request->isAjax()){
        	$param = [
                'username' => 'username',
            ];

            $param_data = $members->buildParam($param);	
            dump($param_data);
        	}
    }
}
