<?php /*a:3:{s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\seller\index.html";i:1540516479;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540782757;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/../static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/../static/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/../static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/../static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/../static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/../static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/../static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/../static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title><?php echo htmlspecialchars((isset($list['title']) && ($list['title'] !== '')?$list['title']:"客户管理系统")); ?></title>
<meta name="keywords" content="<?php echo htmlspecialchars((isset($list['keywords']) && ($list['keywords'] !== '')?$list['keywords']:"关键字，待定义")); ?>">
<meta name="description" content="<?php echo htmlspecialchars((isset($list['description']) && ($list['description'] !== '')?$list['description']:"简介，待定义")); ?>">
</head>
<body>
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 
	<?php if(isset($common_column_title['one_title'])): ?>
	<span class="c-gray en">&gt;</span> <?php echo htmlspecialchars($common_column_title['one_title']); endif; if(isset($common_column_title['two_title'])): ?>
	<span class="c-gray en">&gt;</span> <?php echo htmlspecialchars($common_column_title['two_title']); endif; ?>
	
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">

	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			全局操作
		<input class="btn btn-primary radius" type="button" name="btn1" value="全选">
		<input class="btn btn-primary radius" type="button" name="btn2" value="反选">
		<input class="btn btn-primary radius" type="button" name="btn3" value="不选">
	</span> 
		<span class="r">共有数据：<strong><?php echo htmlspecialchars($count); ?></strong> 条</span> 
	</div>
	<div class="mt-20">
		<form action="<?php echo url('seller_status_editPost'); ?>" method="post"  id="form-member-add" enctype="multipart/form-data">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
				<tr class="text-l">
					<th width="10">ID</th>
					<th width="30">用户名</th>
					<th width="200">微信   
						<input type="button" name="weixin1-btn1"  class="weixin1-btn1" style="width: 40px;color: #fff; background-color: #3bb4f2; border-color: #3bb4f2;border-radius: 5px;" value="全选">
						<input type="button" name="weixin2-btn2"  class="weixin2-btn2" style="width: 40px;color: #fff; background-color: #3bb4f2; border-color: #3bb4f2;border-radius: 4px;" value="反选"> 
						<input type="button" name="weixin3-btn3"  class="weixin3-btn3" style="width: 40px;color: #fff; background-color: #3bb4f2; border-color: #3bb4f2;border-radius: 4px;" value="不选">
					</th>
					<th width="200">QQ   
						<input type="button" name="qq1-btn1"  class="qq1-btn1" style="width: 40px;color: #fff; background-color: #3bb4f2; border-color: #3bb4f2;border-radius: 4px;" value="全选">
					 	<input type="button" name="qq2-btn2"  class="qq2-btn2" style="width: 40px;color: #fff; background-color: #3bb4f2; border-color: #3bb4f2;border-radius: 4px;" value="反选">
					 	<input type="button" name="qq3-btn3"  class="qq3-btn3" style="width: 40px;color: #fff; background-color: #3bb4f2; border-color: #3bb4f2;border-radius: 4px;" value="不选">
					 </th>

				</tr>
			</thead>
			<tbody>
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr class="text-l">
					<td><?php echo htmlspecialchars($vo['id']); ?></td>
					<td><?php echo htmlspecialchars($vo['user_login']); ?></td>
					<td>				
					<?php if(is_array($vo['wx_seller_contact_list']) || $vo['wx_seller_contact_list'] instanceof \think\Collection || $vo['wx_seller_contact_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['wx_seller_contact_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
					
					<div style="display:inline;width: 120px;min-height: 60px;">
					<div style="width: 120px;height: 60px;border: solid 1px #ddd;margin-top: 2px;float: left;margin-left: 2px;position:relative;">	
		
					 	
					 	<div style="float: left;width: 20px;height: 60px;text-align: center;line-height: 60px;">
					 		<input type="checkbox" class="wx" value="<?php echo htmlspecialchars($sub['id']); ?>" name="wq[]" <?php if($sub['online'] == '1'): ?>checked="checked"<?php endif; ?> />
					 	</div>
					 	<div style="float: left;width: 100px;line-height: 20px;padding: 10px 0 10px 0;">
					 		<div class="text-l"><?php echo htmlspecialchars(mb_substr($sub['name'],0,8)); ?></div>
					 		<div class="text-l"><?php echo htmlspecialchars(mb_substr($sub['value'],0,8)); ?></div>
					 	</div>
						<?php if(!(empty($sub['qrcode']) || (($sub['qrcode'] instanceof \think\Collection || $sub['qrcode'] instanceof \think\Paginator ) && $sub['qrcode']->isEmpty()))): ?>
					 	<div style="width:20px; border-radius:60%; position:absolute; right:0px; top:-5px;">
						<img src='/../static/<?php echo htmlspecialchars($sub['qrcode']); ?>' id="input_imgurl" style='width:20px'>
						</div>
					 	<?php endif; ?>	
					</div>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</td>
					<td class="text-l">
						<?php if(is_array($vo['qq_seller_contact_list']) || $vo['qq_seller_contact_list'] instanceof \think\Collection || $vo['qq_seller_contact_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['qq_seller_contact_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$suc): $mod = ($i % 2 );++$i;?>
					<div style="display:inline;width: 120px;min-height: 60px;">
		
					<div style="width: 120px;min-height: 60px;border: solid 1px #ddd;margin-top: 2px;float: left;margin-left: 2px;position:relative;">	
						<div style="float: left;width: 20px;height: 60px;text-align: center;line-height: 60px;">
					 		<input type="checkbox" class="qq" value="<?php echo htmlspecialchars($suc['id']); ?>" name="wq[]" <?php if($suc['online'] == '1'): ?> checked="checked" <?php endif; ?> />
					 	</div>
					 	<div style="float: left;width: 100px;line-height: 20px;padding: 10px 0 10px 0;">
					 		<div class="text-l"><?php echo htmlspecialchars(mb_substr($suc['name'],0,8)); ?></div>
					 		<div class="text-l"><?php echo htmlspecialchars(mb_substr($suc['value'],0,10)); ?></div>
					 	</div>
					 	<?php if(!(empty($suc['qrcode']) || (($suc['qrcode'] instanceof \think\Collection || $suc['qrcode'] instanceof \think\Paginator ) && $suc['qrcode']->isEmpty()))): ?>
					 	<div style="width:20px; border-radius:60%; position:absolute; right:0px; top:-5px;">
						<img src='/../static/<?php echo htmlspecialchars($suc['qrcode']); ?>' id="input_imgurl" style='width:20px;'>
						</div>
					 	<?php endif; ?>
					 	
					</div>
					

					
					
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</td>
					</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>


		<table class="table table-border table-bordered table-striped">
		<tbody>
		<tr class="text-r" style="padding-right: 20px;margin-top: 10px">
				<td colspan="16"><input class="btn btn-primary size-M radius" name="sub1" type="button" value="提交"></td>
		</tr>
		</tbody>
		</table>
	</div>
	</form>
</div>
<script type="text/javascript" src="/../static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/../static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/../static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/../static/static/h-ui.admin/js/H-ui.admin.js"></script>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/../static/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/../static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/../static/lib/laypage/1.2/laypage.js"></script>


<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"paging": false, // 禁止分页
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,2,3]}// 不参与排序的列
	]
	});
});



    $(function() {
    	//全局操作全选
        $("input[name='btn1']").on('click',function(){
        	$("input").each(function(){
			$("input").prop('checked',true);
			});
        });
        //全局操作反选
        $("input[name='btn2']").on('click',function(){
        	$("input").each(function(){
        	$(this).prop('checked',!$(this).prop('checked'));
			
			});
        });
        //全局操作不选
        $("input[name='btn3']").on('click',function(){
        	$("input").each(function(){
			$("input").prop('checked',false);
			});
        });
        
     }); 
</script>

<script type="text/javascript">

		//weixin操作全选
		$("input[name='weixin1-btn1']").on('click',function(){
			$(".wx").each(function(){
        	$(this).prop("checked",true);
			});
		});

        //wx操作反选
        $("input[name='weixin2-btn2']").on('click',function(){
        	$(".wx").each(function(){
        	$(this).prop('checked',!$(this).prop('checked'));
			});
        });

        //wx操作不选
        $("input[name='weixin3-btn3']").on('click',function(){
        	$(".wx").each(function(){
			$(".wx").prop('checked',false);
			});
        });



        //qq操作全选
        $("input[name='qq1-btn1']").on('click',function(){
        	$(".qq").each(function(){
        	$(this).prop("checked",true);
			});
        });

        //qq操作反选
        $("input[name='qq2-btn2']").on('click',function(){
        	$(".qq").each(function(){
        	$(this).prop('checked',!$(this).prop('checked'));
			
			});
        });

        //qq操作不选
        $("input[name='qq3-btn3']").on('click',function(){
        	$(".qq").each(function(){
			$(".qq").attr("checked",false);
			});
        });
                  
</script>
<script type="text/javascript">     
    $(function() {

        //ajax更新状态
        $("input[name='sub1']").on('click',function(){
        	$('#form-member-add').serialize(), //将该表单序列化
        	console.log($('#form-member-add').serialize());
        	$.ajax({
			type: 'POST',
			url: "<?php echo url('seller_status_editPost'); ?>",
			data: $('#form-member-add').serialize(), //将该表单序列化
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.status=='1'){
				    layer.msg(data.msg,{icon:1,time:1000});
				}else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
			});	
	        });
        
     }); 
</script>
</body>
</html>