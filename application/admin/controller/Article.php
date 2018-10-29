<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Request;
use think\facade\Validate;
use think\Db;
use app\admin\model\Article as ArticleModel;

use app\admin\model\ArticleCategory as ArticleCategoryModel;
use app\common\validate\ArticleCategory as ArticleCategoryValidate;
use app\common\validate\Article as ArticleValidate;


class Article extends Common
{
    protected $beforeActionList = [
        'three'  => ['only'=>'edit,delete,a_delete'],

    ];

    public function three(){

        $data=$this->request->param();
        $validate = new ArticleValidate;
        $result   = $validate->scene('check_id')->check($data);
        if (!$result) {
            $this->error($validate->getError());
        }

    }
    public function index()
    {
        $artice=new ArticleModel;
        $article_category=new ArticleCategoryModel;

    	$list = $artice->where('status','1')->order('id', 'desc')->paginate();
    	$count =$artice->where('status','1')->count();
    	foreach($list as $key=>$value){
    		if(empty($value['article_category_id'])){
    			$list[$key]['cate_name']	="未分类";
    		}else{
                $list[$key]['cate_name'] = $article_category->where('id',$value['article_category_id'])->value('name');
    			
    		}
    	}
    	//dump($list);
    	$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch();


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
	public function add()
    {
    	$product= Db::name('article_category')->where('status','1')->select();
		$list=$this->getTree($product);
		$this->assign('list',$list);

    	return $this->fetch();
    }
    public function addPost()
    {


        $artice=new ArticleModel;
        $validate=new ArticleValidate;

        $data = request()->only(['title','sort','keywords','description','content','imgurl','allowcomments','article_category_id']);
        if (!$validate->scene('article_add')->check($data)) {
            $this->error($validate->getError());
        }

        $list=$artice->allowField(['title','sort','keywords','description','content','imgurl','allowcomments','article_category_id'])->save($data);

        if($list) {

            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('操作成功', '',array('data'=>''));
        } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('操作失败');
        }


        return json($info);
        
    }
    public function edit()
    {
        $artice=new ArticleModel;
        $article_category=new ArticleCategoryModel;

    	$id=$this->request->param('id');

    	$res=$artice->where(array('id'=>$id))->find();
        //dump($res);

    	$product= $article_category->select();
    	
    	$list=$this->getTree($product);
    	$this->assign('list',$list);
    	$this->assign('res',$res);
    	return $this->fetch();
    }
    public function editPost()
    {
    	
    	$id=$this->request->param('id');

        $artice=new ArticleModel;
        $validate=new ArticleValidate;


        $data = request()->only(['title','sort','keywords','description','content','imgurl','allowcomments','article_category_id']);
        if (!$validate->scene('article_edit')->check($data)) {
            $this->error($validate->getError());
        }
        //dump($data);
        $result =$artice->allowField(['title','sort','keywords','description','content','imgurl','allowcomments'.'article_category_id'])->save($_POST, ['id' => $id]);
    	
        if($result) {

            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('操作成功');
        } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('操作失败');
        }
    }
        
    public function a_addPost()
    {

        $article_category=new ArticleCategoryModel;

        $validate=new ArticleCategoryValidate;
        $data = request()->param();

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }

        $list=$article_category->allowField(['name','pid'])->save($data);

        if($list) {

            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('操作成功', '',array('data'=>''));
        } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('操作失败');
        }
        
    }     
    public function a_edit()
    {
    	$product= Db::name('article_category')->where('status','1')->select();
		$list=$this->getTree($product);
    	$this->assign('list',$list);
    	
    	$id=$this->request->param('id');
    	$res=Db::name('article_category')->where(array('id'=>$id))->find();
    	$this->assign('res',$res);
    	return $this->fetch();
    } 
    public function aeditdPost()
    {

    	$article_category=new ArticleCategoryModel;
    	$data=$this->request->param();
        $validate=new ArticleCategoryValidate;

        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }
        
        $result = $article_category->allowField(['pid','name'])->save($_POST, ['id' => $data['id']]);
    	
    	if ($result) {
    		$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    
    public function delete()
    {
    	$artice=new ArticleModel;
    	$id=$this->request->param('id');
 
        $del=$artice->where('id',$id)->update(array('status'=>'0'));
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
    public function delete_up()
    {
    	
    	$id=$this->request->param('id');
		$del=Db::name('article')->where('id',$id)->update(array('status'=>'1'));
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }    
    public function category()
    {
        $article_category=new ArticleCategoryModel;
        
        $list= $article_category->where('status','1')->paginate(15);
        $page = $list->render();
        $list=$this->getTree($list);
		$count = $article_category->where('status','1')->count();
        foreach($list as $key=>$value){
             $list[$key]['pid_name']=$article_category->get_pid_cate($value['pid']);
        }

        $this->assign('page', $page);
    	$this->assign('count',$count);
    	$this->assign('list',$list);
    	return $this->fetch();
    } 
	public function cadd()
    {
    	
    	$product= Db::name('article_category')->where('status','1')->select();
		$list=$this->getTree($product);
    	$this->assign('list',$list);
    	return $this->fetch();
    } 
   
    public function a_delete()
    {
    	
    	$id=$this->request->param('id');
        $article_category=new ArticleCategoryModel;
        
        $del=$article_category->where('id',$id)->update(array('status'=>'0'));
    	if ($del) {
    		
			$info=['status' => '1','code'=>'002','msg'=>'操作成功'];
        } else {
            $info=['status' => '0','code'=>'002','msg'=>'操作失败'];
        }
		return json($info);
    }
   	public function recycle(){

        $artice=new ArticleModel;
   	    $list =$artice->where('status','<>','1')->paginate(15);
    	$count = $artice->where('status','<>','1')->count();
    	foreach($list as $key=>$value){
    		
    		if(empty($value['article_category_id'])){
    			$list[$key]['cate_name']	="未分类";
    		}else{
    			$list[$key]['cate_name'] = Db::name('article_category')->where('id',$value['article_category_id'])->value('name');
    			
    		}
    		
    	}
    	//dump($list);
    	$this->assign('count',$count);
    	$this->assign('list',$list);
        return $this->fetch();
   	}    
    
                  	    	       	    
	}
