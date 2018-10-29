<?php
namespace app\api\model;
use think\Model;

class SellerContact extends Model
{
    protected $table = 'crm_seller_contact';
    
    
    public function div_seller_contact_list($where)
    {
    	
    	//查询数据库
        $list=$this->where('online','1')->field('sid,type,name,value,qrcode')->where($where)->order('id desc')->select();
        $result =   [];  //初始化一个数组
        //根据用户ID分类，调用分类函数
        $result=array_same_key_dskjj($list,'sid');
        if(!$result){
            return false;
            exit;
        }
            
        foreach($result as $k=>$v){
        	
        	//根据联系方式分类，1微信2QQ
        	$result1[$k]['wqlist']=array_same_key_dskjj($result[$k],'type');
            	if(!empty($result1[$k]['wqlist']['1'])){
            		//微信数据
            		$result2[$k]['wxlist']=$result1[$k]['wqlist']['1'];
            }else{
            	$result2[$k]['wxlist']=array();
            }
            if(!empty($result1[$k]['wqlist']['2'])){
            	//QQ数组
            	$result2[$k]['qqlist']=$result1[$k]['wqlist']['2'];
            }else{
            	//避免报错，赋值空数组
            	$result2[$k]['qqlist']=array();
            }
            
        }
        foreach($result2 as $k=>$v){
        	//判断哪个数组比较长。自动循环补齐数组，如有一个数组为空直接返回长的数组
            if(count($v['wxlist'])>count($v['qqlist'])){
            	//调用自身循环补齐
            	$result2[$k]['qqlist2']=run_array_edit($v['wxlist'],$v['qqlist']);
            	$result2[$k]['wxlist2']=$v['wxlist'];
            }else{
            	$result2[$k]['wxlist2']=run_array_edit($v['wxlist'],$v['qqlist']);
            	$result2[$k]['qqlist2']=$v['qqlist'];
            }
 		}
 			
 		foreach($result2 as $k3=>$v3){
 			//微信QQ拼接，执行拼接函数
            $v3['wqlist3']=run_array_merge($v3['wxlist2'],$v3['qqlist2']);

            $wqlist4[]=array_values($v3['wqlist3']);

 		}

        //dump($wqlist4);exit;
 		//将二维数组变为一维数组	
 		foreach($wqlist4 as $key=>$val){
			foreach($val as $k=>$v){
					$wqlist5[]=$v;
			}	
		}
		//返回结果集
        return $wqlist5;
        //dump($wqlist5);exit;
        
        
    }
}
