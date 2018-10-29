<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Request;


class Index extends Common{
    public function index()
    {
        return $this->fetch();
    }
    public function welcome()
    {
        return $this->fetch();
    }    
}
