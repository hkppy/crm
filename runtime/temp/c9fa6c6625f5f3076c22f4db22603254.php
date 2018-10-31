<?php /*a:4:{s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\admin\admin_list.html";i:1540870361;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540782757;s:92:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_column_title.html";i:1538040490;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
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

		<a href="javascript:;" onclick="admin_add('添加管理员','<?php echo url('admin_add'); ?>','800','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
	</span> <span class="r">共有数据：<strong><?php echo htmlspecialchars($count); ?></strong> 条</span> </div>
		<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">登录名</th>
				<th width="150">邮箱</th>
				<th>角色</th>
				<th width="130">加入时间</th>
				<th width="100">是否已启用</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($list as $key=>$vo): ?> 
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo htmlspecialchars($vo['id']); ?>" name=""></td>
				<td><?php echo htmlspecialchars($vo['id']); ?></td>
				<td><?php echo htmlspecialchars($vo['user_login']); ?></td>
				<td><?php echo htmlspecialchars($vo['user_email']); ?></td>
				<td><?php echo htmlspecialchars($vo['role_name']); ?></td>
				<td><?php echo htmlspecialchars(date('Y-m-d h:i:s',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></td>
				<?php if($vo['status'] == '1'): ?><td class="td-status"><span class="label label-success radius">已启用</span></td>
				<?php else: ?> <td class="td-status"><span class="label radius">已停用</span></td>
				<?php endif; ?>
				<td class="td-manage">
					<?php if($vo['id'] != '1'): if($vo['status'] == '1'): ?>
					<a style="text-decoration:none" onClick="admin_stop(this,'<?php echo htmlspecialchars($vo['id']); ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
					<?php else: ?> <a onClick="admin_start(this,<?php echo htmlspecialchars($vo['id']); ?>)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>
					<?php endif; endif; ?>
					<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','<?php echo url('admin_edit',array('id'=>$vo['id'])); ?>','<?php echo htmlspecialchars($vo['id']); ?>','800','600')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a style="text-decoration:none" class="ml-5" onClick="change_password('密码重置','<?php echo url('resetpwd',array('id'=>$vo['id'])); ?>','1','800','600')" href="javascript:;" title="密码重置"><i class="Hui-iconfont">&#xe63f;</i></a> 
					<?php if($vo['id'] != '1'): ?>
					<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo htmlspecialchars($vo['id']); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					<?php endif; ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div style="" class="fenye"><?php echo $list; ?></div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/../static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/../static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/../static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/../static/static/h-ui.admin/js/H-ui.admin.js"></script>
 
	
<!--/_footer 作为公共模版分离出去-->

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
	  {"orderable":false,"aTargets":[0,2,3,4,5,6,7]}// 不参与排序的列
	]
	});
});
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		console.log(id);
		$.ajax({
			type: 'POST',
			url: "<?php echo url('delete'); ?>",
			data: {'id':id},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.status=='1'){
					$(obj).parents("tr").remove();
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
}

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}


/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		console.log(id);
		$.ajax({
			type: 'POST',
			url: "<?php echo url('post_up'); ?>",
			data: {'id':id},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.status=='1'){
				$(obj).parents("tr").find(".td-manage").prepend("<a onClick='admin_start(this,"+id+")' href='javascript:;' title='启用' style='text-decoration:none'><i class='Hui-iconfont'>&#xe615;</i></a>");
				$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
				$(obj).remove();
				layer.msg('已停用!',{icon: 5,time:1000});
				}else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	

	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('post_do'); ?>",
			data: {'id':id},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.status=='1'){
				//此处请求后台程序，下方是成功后的前台处理……
				$(obj).parents("tr").find(".td-manage").prepend("<a onClick='admin_stop(this,"+id+")' href='javascript:;' title='停用' style='text-decoration:none'><i class='Hui-iconfont'>&#xe631;</i></a>");
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				$(obj).remove();
				layer.msg('已启用!', {icon: 6,time:1000});
				}else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	
		

	});
}
</script>
</body>
</html>