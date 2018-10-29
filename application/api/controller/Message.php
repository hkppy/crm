<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Message as MessageModel;
use app\api\validate\Customer as CustomerValidate;

class Message extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function lists()
    {
        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('aid')->check($data)) {
            $this->error($validate->getError());
        }

        $message=new MessageModel;

        $message_cache='message_list';
        
        $message_list2=cache($message_cache);
        
        if(!$message_list2){
            $message_list = $message->where('status', 1)->order('id', 'asc')->select();
            cache($message_cache,$message_list);
            $message_list2=cache($message_cache);
            //echo "我是新缓存";
        }   
        
        if($message_list2) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',$message_list2);
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
        $message=new MessageModel;
        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('save')->check($data)) {
            $this->error($validate->getError());
        }


        $data['uid']=session('api_uid');

        $list=$message->allowField(['aid','title','content','uid'])->save($data);

        if($list) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('操作成功');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('操作失败');
        }


    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id='')
    {
        $message=new MessageModel;

        $validate = new CustomerValidate;
        
        $data = request()->param();
        
        if (!$validate->scene('read')->check($data)) {
            $this->error($validate->getError());
        }
        $message_read = $message->get($id,true);
        if($message_read) {
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('请求成功', '',array('data'=>$message_read));
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('评论内容不存在');
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
    public function delete($id)
    {
        //
    }
}
