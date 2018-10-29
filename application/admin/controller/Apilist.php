<?php

namespace app\admin\controller;

use think\Controller;

use think\facade\Debug;
use think\facade\Request;
use think\facade\Validate;

use app\admin\model\Apilist as ApilistModel;
use app\common\validate\Customer as CustomerValidate;

class Apilist extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $apilist=new ApilistModel;
        $list = $apilist->where('status','1')->order('id', 'desc')->paginate();
        $count =$apilist->where('status','1')->count();

        $this->assign('count',$count);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
        return $this->fetch();
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
        $apilist=new ApilistModel;

        $data['title']=$this->request->param('title');
        $list1 = $apilist->where('title', $data['title'])->find();
        if($list1){
            $this->error('接口名称已存在，请更换！');
        }


        $list2=$apilist->allowField(['title','url','description'])->save($_POST);

        if($list2){
            $this->success('新增成功', 'User/list');
        }else{
            $this->error('新增失败');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(Request $request)
    {
        $apilist=new ApilistModel;
        $validate=new  CustomerValidate;

        $data = request()->param();
        if (!$validate->scene('api_edit')->check($data)) {
            $this->error($validate->getError());
        }

        $data['id']=$this->request->param('id');
        $list = $apilist->where('id', $data['id'])->find();
        $this->assign('list',$list);
        return $this->fetch();
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
        $apilist=new ApilistModel;
        $validate=new  CustomerValidate;

        $data = request()->param();
        if (!$validate->scene('api_update')->check($data)) {
            $this->error($validate->getError());
        }


        $list=$apilist->allowField(['title','url','description'])->save($_POST, ['id' => $id]);

        if($list){
            $this->success('操作成功', 'User/list');
        }else{
            $this->error('操作失败');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $apilist=new ApilistModel;
        $validate=new  CustomerValidate;

        $data = request()->param();
        if (!$validate->scene('api_id')->check($data)) {
            $this->error($validate->getError());
        }
        $list=$apilist->where('id', $id)->update(['status' => '0']);
        if($list){
            $this->success('操作成功', 'User/list');
        }else{
            $this->error('操作失败');
        }

    }
}
