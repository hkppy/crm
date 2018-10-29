<?php

namespace app\api\controller;
use think\Controller;

use app\api\model\Article as ArticleModel;
use app\api\validate\Customer as CustomerValidate;

class Article extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */

    public function lists()
    {
    	$artice=new ArticleModel;

    	$artice_cache='artice_list';
    	
    	$artice_list2=cache($artice_cache);
    	
    	if(!$artice_list2){
        	$artice_list = $artice->where('status', 1)->order('id', 'asc')->paginate(20);
        	cache($artice_cache,$artice_list);
        	$artice_list2=cache($artice_cache);
        	//echo "我是新缓存";
        }	
		
        if($artice_list2) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',$artice_list2);
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('请求失败');
        }
        
        
    }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id='')
    {
    	$artice=new ArticleModel;

        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('read')->check($data)) {
            $this->error($validate->getError());
        }

        $artice_read = $artice->get($id,true);
		if($artice_read) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',array('data'=>$artice_read));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('文章内容不存在');
        }
        
        
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id='')
    {
        $artice=new ArticleModel;

        //$artice_delete = $artice->where('id','=',$id)->delete();
        
      	if($artice_delete) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',array('data'=>$artice_delete));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('参数错误');
        }
 
    }
}
