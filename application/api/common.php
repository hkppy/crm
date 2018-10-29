<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
//返回数组个数
function run_array($array=array()) {
    return count($array);
}

//循环补齐数组
function run_array_edit($a1=array(),$b1=array()){
	
	
	if(!empty($a1)&&!empty($b1)){
		$i=count($a1);
		$x=count($b1);
		$arr=array();
		if($i>$x){
			for($a=0;$a<$i-$x;$a++){
			$b1[]=$b1[$a];
			}
			return $b1;	
			
		}else{
			for($p=0;$p<$x-$i;$p++){
			$a1[]=$a1[$p];
			//dump($a1[$a]);
			}
			return $a1;	
		}
	}else{
		
		if(count($a1)>count($b1)){
			return $a1;	
		}else{
			return $b1;	
		}
		
		
	}
	
}



//连接两个数组
function run_array_merge($a1=array(),$b1=array()){
		$arr=array();
		$a2=array();

		$b2=array();

		foreach ($a1 as $key => $value) {
			$a2[$key]['weixin']=$value['value'];
			$a2[$key]['wxname']=$value['name'];
			$a2[$key]['wxqrcode']=$value['qrcode'];
		}

		foreach ($b1 as $k => $v) {
			$b2[$k]['qq']=$v['value'];
			$b2[$k]['qqname']=$v['name'];
			$b2[$k]['qqqrcode']=$v['qrcode'];
		}


		foreach ($a2 as $key => $value) {

			$a3[]=common_array_merge($a2[$key],$b2[$key]);

		}

		return $a3;

}


function common_array_merge($a=array(),$b=array()){

	$arr2=array();

	$arr2=array_merge($a,$b);
	return $arr2;

}

//数组type分类	1.wx;2.qq
function array_same_key($list=array(),$id){
	
		$new_array=array();
		foreach( $list as $key => $val )
		{
			if($val['type']==$id){
			
			if( in_array( $val, $new_array ) )
		    {
		       // echo $key;
		        continue;
		    }
		    else
		    {
		        $new_array[] = $val;
		    }
		   }
		   
		}
		return $new_array;
}

function array_same_key_dskjj($list=array(),$key){
	$result=[];
    foreach($list as $k=>$v){
		$result[$v[$key]][]  =  $v;  //根据initial 进行数组重新赋值
		
	}
	return $result;
}					