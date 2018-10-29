<?php /*a:3:{s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\message\edit.html";i:1539151888;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1538020752;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>添加文章</title>
</head>
<body>
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 
	<?php if(isset($common_column_title['one_title'])): ?>
	<span class="c-gray en">&gt;</span> <?php echo htmlentities($common_column_title['one_title']); endif; if(isset($common_column_title['two_title'])): ?>
	<span class="c-gray en">&gt;</span> <?php echo htmlentities($common_column_title['two_title']); endif; ?>
	
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add">

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>消息类型：</label>
			<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<?php switch($list['messages_type']): case "1": ?>公告<?php break; case "2": ?>站内信<?php break; default: ?>未选择
						<?php endswitch; ?>
						</span>
			</div>
		</div>
		
		<?php if(!(empty($list['recipient_uid']) || (($list['recipient_uid'] instanceof \think\Collection || $list['recipient_uid'] instanceof \think\Paginator ) && $list['recipient_uid']->isEmpty()))): ?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>收件人：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="recipient_uid" name="recipient_uid">
			</div>
		</div>
		<?php endif; ?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlentities($list['title']); ?>" placeholder="" id="title" name="title">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor" name="content" type="text/plain" style="width:100%;height:400px;"><?php echo $list['content']; ?></script> 
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
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

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	//表单验证
	$("#form-article-add").validate({
		rules:{
			title:{
				required:true,
			},

			articlecolumn:{
				required:true,
			},
			articletype:{
				required:true,
			},
			sort:{
				required:true,
			},
			keywords:{
				required:true,
			},
			description:{
				required:true,
			},
			author:{
				required:true,
			},
			sources:{
				required:true,
			},
			allowcomments:{
				required:true,
			},
			commentdatemin:{
				required:true,
			},
			commentdatemax:{
				required:true,
			},

		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			console.log($('#form-article-add').serialize());
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php echo url('addPost'); ?>" ,
				data: $('#form-article-add').serialize(), //将该表单序列化
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
		}
	});

	var ue = UE.getEditor('editor');
});
</script>
<script>
	$(function() {
		$('input[type="file"]').on('change', function() {
			var file = this.files[0];
			var formData = new FormData($('#form-article-add')[0]);
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
					$("#imgurl").val(data.imgurl);
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