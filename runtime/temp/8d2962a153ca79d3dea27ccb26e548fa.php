<?php /*a:3:{s:80:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\rbac\rbac_edit.html";i:1539137364;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540259350;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
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
<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($auth_rule['id']); ?>">
		
		<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						上级栏目：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select class="select" id="pid" name="pid" onchange="SetSubID(this);">
							<option value="0" >顶级分类</option>
							<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							
							<option value="<?php echo htmlspecialchars($vo['id']); ?>" <?php if($vo['id'] == $auth_rule['pid']): ?>selected="selected"<?php endif; ?>><?php echo htmlspecialchars($vo['title']); ?></option>
							<?php if($vo['new_data'] != ''): if(is_array($vo['new_data']) || $vo['new_data'] instanceof \think\Collection || $vo['new_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['new_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
							   <option value="<?php echo htmlspecialchars($vo['id']); ?>" <?php if($v2['id'] == $auth_rule['pid']): ?>selected="selected"<?php endif; ?>>&nbsp;&nbsp;├ <?php echo htmlspecialchars($v2['title']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span>
					</div>
					<div class="col-3">
					</div>
		</div>
		
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($auth_rule['title']); ?>" placeholder="" id="title" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>执行方法：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($auth_rule['name']); ?>" placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>style_id：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($auth_rule['style_id']); ?>" placeholder="" id="style_id" name="style_id">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>字体图标编码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($auth_rule['font_code']); ?>" placeholder="" id="font_code" name="font_code">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($auth_rule['note']); ?>" placeholder="" id="" name="note">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">排序：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($auth_rule['sort']); ?>" placeholder="" id="sort" name="sort">
			</div>
		</div>
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否在栏目显示：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box" style="padding-left: 0px; ">
				<input  type="radio" value="1" name="is_display" <?php if($auth_rule['is_display'] == '1'): ?>checked="checked"<?php endif; ?>>
				<label for="sex-1">展示</label>
			</div>
			<div class="radio-box" style="padding-left: 0px; ">
				<input type="radio" value="0" name="is_display" <?php if($auth_rule['is_display'] == '0'): ?>checked="checked"<?php endif; ?>>
				<label for="sex-2">不展示</label>
			</div>
		</div>
		</div>
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否启用：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box" style="padding-left: 0px; ">
				<input  type="radio" value="1" name="status" <?php if($auth_rule['status'] == '1'): ?>checked="checked"<?php endif; ?>>
				<label for="sex-1">启用</label>
			</div>
			<div class="radio-box" style="padding-left: 0px; ">
				<input type="radio" value="0" name="status" <?php if($auth_rule['status'] == '0'): ?>checked="checked"<?php endif; ?>>
				<label for="sex-2">未启用</label>
			</div>
		</div>
		</div>
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/../static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/../static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/../static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/../static/static/h-ui.admin/js/H-ui.admin.js"></script>
 	
	
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/../static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/../static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/../static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	
	$("#form-admin-role-add").validate({
		rules:{
			roleName:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php echo url('editPost'); ?>" ,
				data: $('#form-admin-role-add').serialize(), //将该表单序列化
				success: function(data){
					console.log(data);
					if(data.status==1){
						layer.msg(data.msg,{icon:1,time:1000});
					}else{
						layer.msg(data.msg,{icon:2,time:1000});
					}
					
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
			//var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			//parent.layer.close(index);
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>