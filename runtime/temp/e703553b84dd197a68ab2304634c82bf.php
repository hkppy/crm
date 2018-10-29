<?php /*a:3:{s:84:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\seller\seller_show.html";i:1538723595;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1538020752;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
<!--_meta 作为公共模版分离出去-->
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
<script type="text/javascript" src="/static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/static/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />

<!--[if IE 6]>
<script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加用户 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<input type="hidden" name="sid" value="<?php echo htmlentities($sid); ?>">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类型：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input type="radio" id="sex-2" name="type" value="1" >
					<label for="sex-2">微信</label>
				</div>
				<div class="radio-box">
					<input  type="radio" id="sex-1" name="type" value="2" >
					<label for="sex-1">QQ</label>
				</div>

				<div class="radio-box">
					<input type="radio" id="sex-3" name="type" value="3" >
					<label for="sex-3">其他</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>联系名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"placeholder="" id="name" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>联系号码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"placeholder="" id="value" name="value">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>二维码：</label>
			<div class="formControls col-xs-8 col-sm-9" >
				<input name="file" type="file" id="file"> 
			</div>
		</div>
		<div class="row cl" style="height: 100px;">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>二维码缩略图：</label>
			<div class="formControls col-xs-8 col-sm-9" id="imgurl">
			<img src='/static/style/images/imgup.png' id="input_imgurl" style='width:100px'>
			<input type='hidden' name='qrcode' id="qrcode" >	
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  placeholder="" id="sort" name="sort">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否在线：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input  type="radio" id="sex-1" name="online" value="1" >
					<label for="sex-1">在线</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="online" value="2" >
					<label for="sex-2">不在线</label>
				</div>

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
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>

<!--/_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			value:{
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
				url: "<?php echo url('seller_show_editPost'); ?>" ,
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

<script>
	$(function() {
		$('input[type="file"]').on('change', function() {
			var file = this.files[0];
			var formData = new FormData($('#form-member-add')[0]);
			formData.append('file', file);
			console.log(formData.get('file'))
			$.ajax({
				url: '<?php echo url('Picture/index'); ?>',
				type: 'POST',
				data: formData,
				async:  false,
				cache: false,
				contentType:  false,
				processData:  false, //不处理数据
				success: function(data) {
					console.log(data);
					//alert(data.msg);
					layer.msg(data.msg,{icon:1,time:1000});
					$("#input_imgurl").attr("src","/static/"+data.imgurl);
					$("#qrcode").val(data.imgurl);
				},
				error: function() {
					alert("上传失败！");
				}
			})
		});
	})
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>