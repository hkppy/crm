<?php
namespace app\demo\controller;
use think\Controller;
use think\facade\Request;

use app\common\model\Members as MembersModel;
class Index extends Controller
{
    public function index()
    {

        	$members= new MembersModel;


        	 $param = [
                   'username'=>'username',
                   'username2'=>'username2',
                ];

            $data = $members->buildParam($param);
            dump($data);
    }
}
