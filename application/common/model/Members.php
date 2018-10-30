<?php

namespace app\common\model;
use think\Model;

class Members extends Model
{
    protected $table = 'crm_members';
    
    public function buildParam($array=[])
    {
        $data=[];
        if (is_array($array)&&!empty($array)){
            foreach( $array as $item=>$value ){
                $data[$item] = $this->request->param($value);
            }
        }
        return $data;
    }

    public function editData($data){

        if (isset($data['id'])){
            if (is_numeric($data['id']) && $data['id']>0){
                    //过滤post数组中的非数据表字段数据
                    $save = $this->allowField(true)->save($data,[ 'id' => $data['id']]);
            }else{
                $save  = $this->allowField(true)->save($data);
            }
        }else{
            $save  = $this->allowField(true)->save($data);
        }
        if ( $save == 0 || $save == false) {
            $res=[  'code'=> 1009,  'msg' => '数据更新失败', ];
        }else{
            $res=[  'code'=> 1001,  'msg' => '数据更新成功',  ];
        }
        return $res;
    }
}
