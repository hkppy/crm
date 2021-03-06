<?php /*a:3:{s:77:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\apilist\add.html";i:1540452543;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540453180;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
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
<meta name="keywords" content="<?php echo htmlspecialchars((isset($list['keywords']) && ($list['keywords'] !== '')?$list['keywords']:"这家伙很懒，什么也没留下")); ?>">
<meta name="description" content="<?php echo htmlspecialchars((isset($list['description']) && ($list['description'] !== '')?$list['description']:"这家伙很懒，什么也没留下")); ?>">
</head>




<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>接口名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value=""  id="title" name="title">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>接口地址：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="模块/控制器/操作方法" id="url" name="url">
		</div>
	</div>

	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">参数说明：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="description" cols="" rows="" class="textarea valid"  ></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
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
	
	$("#form-admin-add").validate({
		rules:{
			title:{
				required:true,
				minlength:2,
				maxlength:16
			},
			url:{
				required:true,
			},

		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php echo url('save'); ?>" ,
				data: $('#form-admin-add').serialize(), //将该表单序列化
				success: function(data){
					console.log(data);
					if(data.code==1){
						layer.msg(data.msg,{icon:1,time:1000});
					}else{
						layer.msg(data.msg,{icon:2,time:1000});
					}
					
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:2,time:1000});
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