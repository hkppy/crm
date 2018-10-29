<?php /*a:3:{s:81:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\role\admin_role.html";i:1540455177;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540453180;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
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
<meta name="keywords" content="<?php echo htmlspecialchars((isset($list['keywords']) && ($list['keywords'] !== '')?$list['keywords']:"这家伙很懒，什么也没留下")); ?>">
<meta name="description" content="<?php echo htmlspecialchars((isset($list['description']) && ($list['description'] !== '')?$list['description']:"这家伙很懒，什么也没留下")); ?>">
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

		<a href="javascript:;" onclick="admin_role_add('添加角色','<?php echo url('role_add'); ?>','800','600')" class="btn btn-primary radius">
			<i class="Hui-iconfont">&#xe600;</i> 添加角色</a></span> 
			<span class="r">共有数据：<strong><?php echo htmlspecialchars($count); ?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th width="200">角色名</th>
				<th width="300">描述</th>
				<th>添加时间</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($list as $key=>$vo): ?> 
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo htmlspecialchars($vo['id']); ?></td>
				<td><?php echo htmlspecialchars($vo['name']); ?></td>
				<td><?php echo htmlspecialchars($vo['remark']); ?></td>
				<td><?php echo htmlspecialchars(date('Y-m-d h:i:s',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></td>
				<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','<?php echo url('role_edit',array('id'=>$vo['id'])); ?>','<?php echo htmlspecialchars($vo['id']); ?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<?php if($vo['id'] != '1'): ?>
					<a title="删除" href="javascript:;" onclick="admin_role_del(this,'<?php echo htmlspecialchars($vo['id']); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
					<?php endif; ?>
				</td>
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
<script type="text/javascript" src="/../static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"paging": false, // 禁止分页
		"bSort": false, //排序功能
		"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,2,3,4,5]}// 不参与排序的列
	]
	});
});
/*管理员-角色-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-编辑*/
function admin_role_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-角色-删除*/
function admin_role_del(obj,id){
	layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
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
</script>
</body>
</html>