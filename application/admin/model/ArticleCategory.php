<?php

namespace app\admin\model;

use think\Model;

class ArticleCategory extends Model
{
    //
    protected $table = 'crm_article_category';

    protected $autoWriteTimestamp = true;
    
    public function get_pid_cate($value)
    {
        if($value=='0'){
        	return $value="顶级分类";
        }else{
        	return $value = $this->where('id',$value)->value('name');
        }
    }

    public function getTree($data,$pid=0,$level=0){
        static $arr=array();
        foreach($data as $key=>$value){
            if($value['pid'] == $pid){
                $value['level']=$level;     //用来作为在模版进行层级的区分
                $arr[] = $value;            //把内容存进去
                $this->getTree($data,$value['id'],$level+1);    //回调进行无线递归
            }
        }
        return $arr;

    } 


}
