<?php /*a:2:{s:77:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\login\index.html";i:1540180468;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
		<meta name="applicable-device" content="pc,mobile">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="stylesheet" type="text/css" href="/../static/style/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/../static/style/css/index.css">
	</head>

	<body class="modal-open">

		<div class="modal fade in" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: block;">
			<div style="display:table; width:100%; height:100%;">
				<div style="vertical-align:middle; display:table-cell;">
					<div class="modal-dialog modal-sm" style="width:540px;">
						<div class="modal-content" style="border: none;">
							<div class="col-left"></div>
							<div class="col-right">
								<div class="modal-header">
									<button type="button" id="login_close" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="loginModalLabel" style="font-size: 18px;">登录</h4>
								</div>
								<div class="modal-body">
									<section class="box-login v5-input-txt" id="box-login">
										<form id="login_form" action="" method="post" autocomplete="off">

											<ul>
												<li class="form-group"><input class="form-control" name="username" id="username" maxlength="50" placeholder="请输入邮箱账号/手机号" type="text"></li>
												<li class="form-group"><input class="form-control" name="password" id="password" placeholder="请输入密码" type="password"></li>

											</ul>
										</form>
										<p class="good-tips marginB10">
											<a id="btnForgetpsw" class="fr">忘记密码？</a>还没有账号？
											<a href="javascript:;" target="_blank" id="btnRegister">立即注册</a>
										</p>
										<div class="login-box marginB10">
											<button id="login_btn" type="button" class="btn btn-micv5 btn-block globalLogin">登录</button>
											<div id="login-form-tips" class="tips-error bg-danger" style="display: none;">错误提示</div>
										</div>


									</section>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-backdrop fade in"></div>
		
	</body>

</html>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/../static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/../static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/../static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/../static/static/h-ui.admin/js/H-ui.admin.js"></script>

<!--/_footer 作为公共模版分离出去-->
<script type="text/javascript">
		$("#login_btn").click(function() {
		var username = $.trim($("#username").val());
		var password = $.trim($("#password").val());
		if(username == "") {
			layer.msg('请输入用户名',{icon:2,time:1000});
			return false;
		} else if(password == "") {
			layer.msg('请输入密码',{icon:2,time:1000});
			return false;
		}
		//ajax去服务器端校验
		var data = {
			username: username,
			password: password
		};

		$.ajax({
			type: "POST",
			url: "<?php echo Url('login/check_login'); ?>",
			data: data,
			dataType: 'json',
			success: function(data) {
				//console.log(data);
				if(data.code==1){
					console.log(data.code);
					layer.msg(data.msg,{icon:1,time:1000});
					window.location.href = "<?php echo Url('Index/index'); ?>";
				}else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
			}
		});
	});
</script>