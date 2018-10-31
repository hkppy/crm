<?php

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\admin\model\CustomerInfo as CustomerInfoModel;

//加载验证类
use app\admin\validate\Customer as CustomerValidate;

class Customer extends Model
{
    use SoftDelete;
    protected $autoWriteTimestamp = true;

    protected $deleteTime = 'delete_time';
    public function getLxfsAttr($value)
    {
        $status = [0=>'未填写',1=>'微信',2=>'QQ',3=>'手机号'];
        return $status[$value];
    }
    public function profile()
    {
        return $this->hasOne('customer_info','cid');
    }
    
    public function profile1()
    {
        return $this->hasOne('user','id','sell_id');
    }

    public function profile2()
    {
        return $this->hasOne('customer_info','cid','id');
    }
    /**
     * 获取客户列表 含append用法
     * @param array $map
     * @param string $order
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getCustomerList($map=[],$order = 'id desc',$page_size='15'){

        $field='id,lxfs ,lxfs_value,sell_id,realname,create_time';
        $map[]=['status','=','1'];
        $data=$this->where($map)->field($field)->order($order)->paginate($page_size);
        foreach ($data as $key => $value) {
            $data[$key]['customer_info_count']=CustomerExpend::where('cid',$value['id'])->count();
            $data[$key]['user_name']=User::where('id',$value['sell_id'])->value('username');
        }
        return $data;
    }
    public function add_post($data=[])
    {

        
        $customer_info=new CustomerInfoModel;
        
        $data['sell_id']=ADMIN_UID;
        $data['uid']=ADMIN_UID;

        if (is_numeric($data['id']) && $data['id']>0){
            $list=$this->allowField(['lxfs','lxfs_value','nickname','realname','password'])->save($data, ['id' => $data['id']]);
            $data['cid']=$this->id;
            $list2=$customer_info->allowField(['nickname','realname','lifa','birthday','notes','address'])->save($data,['cid'=>$data['id']]);
        }else{
            $list=$this->allowField(['lxfs','lxfs_value','nickname','realname','sell_id','uid','password'])->save($data);
            $data['cid']=$this->id;
            $list2=$customer_info->allowField(['nickname','realname','cid','sell_id','uid','lifa','birthday','notes','address'])->save($data);
        }

        if($list&&$list2){
            return true;
        }else{
            return false;
        }


    }
    public function buildParam($array)
    {
        $data=[];
        if (is_array($array)){
            foreach( $array as $item=>$value ){
                $data[$item] = request()->param($value);
            }
        }
        return $data;
    }    
}
