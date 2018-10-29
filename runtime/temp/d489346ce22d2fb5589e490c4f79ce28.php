<?php /*a:3:{s:83:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\seller_group\edit.html";i:1540452802;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540782757;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
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
<title><?php echo htmlspecialchars((isset($list['title']) && ($list['title'] !== '')?$list['title']:"客户管理系统")); ?></title>
<meta name="keywords" content="<?php echo htmlspecialchars((isset($list['keywords']) && ($list['keywords'] !== '')?$list['keywords']:"关键字，待定义")); ?>">
<meta name="description" content="<?php echo htmlspecialchars((isset($list['description']) && ($list['description'] !== '')?$list['description']:"简介，待定义")); ?>">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
				<input type="hidden" name="id" value="<?php echo htmlspecialchars($res['id']); ?>">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						上级分组：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select class="select" id="parent_id" name="parent_id" >
							<option value="0">顶级分类</option>
							<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo htmlspecialchars($vo['id']); ?>" <?php if($vo['id'] == $res['parent_id']): ?>selected="selected"<?php endif; ?>><?php echo htmlspecialchars($vo['group_name']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>

							
						</select>
						</span>
					</div>
					<div class="col-3">
					</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>分组名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($res['group_name']); ?>" placeholder="" id="group_name" name="group_name">
			</div>
		</div>
		<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3" >
					<span class="c-red">*</span>
					用户列表：
					</label>
					<div class="formControls col-xs-8 col-sm-9" style="width:48%;overflow: auto;height: 300px;" >
						<div >
						<?php foreach($list2 as $key=>$vo): if(in_array(($vo['id']), is_array($res['group_sid'])?$res['group_sid']:explode(',',$res['group_sid']))): ?>
						<div class="formControls col-xs-8 col-sm-9 skin-minimal" >
							<div class="check-box" >
								<label for="checkbox-1"><input type="checkbox" id="ids" name="ids[]" value="<?php echo htmlspecialchars($vo['id']); ?>" <?php if(in_array(($vo['id']), is_array($res['group_sid'])?$res['group_sid']:explode(',',$res['group_sid']))): ?>checked='checked'<?php endif; ?> ><?php echo htmlspecialchars($vo['user_login']); ?>
								</label>
								<label for="checkbox-1">&nbsp;</label>
							</div>
						</div>
						<?php endif; endforeach; ?>
						</div>

						<?php foreach($list2 as $key=>$vo): if(!in_array(($vo['id']), is_array($res['group_sid'])?$res['group_sid']:explode(',',$res['group_sid']))): ?>
						<div class="formControls col-xs-8 col-sm-9 skin-minimal">
							<div class="check-box" >
								<label for="checkbox-1"><input type="checkbox" id="ids" name="ids[]" value="<?php echo htmlspecialchars($vo['id']); ?>" <?php if(in_array(($vo['id']), is_array($res['group_sid'])?$res['group_sid']:explode(',',$res['group_sid']))): ?>checked='checked'<?php endif; ?> ><?php echo htmlspecialchars($vo['user_login']); ?>
								</label>
								<label for="checkbox-1">&nbsp;</label>
							</div>
						</div>
						<?php endif; endforeach; ?>
	
					</div>
						
		</div>


		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
<script type="text/javascript" src="/../static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/../static/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/../static/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/../static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			user_name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			password:{
				required:true,
				minlength:2,
				maxlength:16
			},
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php echo url('editPost'); ?>" ,
				data: $('#form-member-add').serialize(), //将该表单序列化
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