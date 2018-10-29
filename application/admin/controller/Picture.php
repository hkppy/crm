<?php
namespace app\admin\controller;
use think\Controller;

class Picture extends Controller
{
    public function index()
    {
        $file = request()->file('file');
        $info = $file->move( 'static/uploads');
    if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
        //echo $info->getExtension();
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        //echo $info->getSaveName();
        // 输出 42a79759f284b767dfcb2a0197904287.jpg
        //echo $info->getFilename(); 
        $imgurl=$info->getSaveName();
        $fileurl="uploads/".$imgurl;
        $info=['status' => '1','code'=>'001','msg'=>'上传成功','imgurl'=>$fileurl];
        return json($info);
    }else{
        // 上传失败获取错误信息
        echo $file->getError();
    }
    }
}
