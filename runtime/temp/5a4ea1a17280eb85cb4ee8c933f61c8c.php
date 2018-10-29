<?php /*a:3:{s:77:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\user\profile.html";i:1539669727;s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header.html";i:1539669711;s:83:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header_menu.html";i:1539738244;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8" />
		<meta name="wap-font-scale" content="no">
		<title>客户管理系统</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<link href="/../static//demo/css/detail.css" rel="stylesheet" type="text/css">
		<link href="/../static//demo/css/style.css" rel="stylesheet" type="text/css">

	</head>
	<body>
		<div class="header">
			客户管理系统
		</div>
		
				<div class="top">
	   		<i class="iconfont icon-caidan caidan"></i>
	   		<div class="brick">
	   				 <span class="nc" >用户名：<span class="username"></span></span>
					<div class="dhk">昵称:<span class="nickname"></span></div>

			</div>
	    	<a href="<?php echo url('Index/index'); ?>" class="home">首页</a>
		    <div class="siderbar">
		        <ul>
		            <li><a href="<?php echo url('Index/index'); ?>" class="activite">我的主页</a></li>
		            <li><a href="<?php echo url('customer/lists'); ?>">我的客户</a></li>
		            <li><a href="<?php echo url('User/agent'); ?>">客户管理</a></li>
		            <li><a href="<?php echo url('User/manage'); ?>">客户消费</a></li>
		            <li><a href="<?php echo url('Chongzhi/index'); ?>">消费管理</a></li>
		            <li><a href="<?php echo url('Notice/index'); ?>">新闻公告</a></li>
		            <li><a href="<?php echo url('user/personal'); ?>">个人信息</a></li>
		            <li><a href="<?php echo url('Advice/index'); ?>">投诉建议</a></li>
		            <li><a href="" id="tuichu">退出</a></li>
		        </ul>
		    </div>
		</div>

		<div class="container">
		<form class="login-form" action="" method="post">
			<div class="agent">
				<div class="agent-title">修改密码</div>
				<div class="ear-list list-title">原密码：<span> <input type="password" id="old"  class="span3" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="old"></span></div>
				<div class="ear-list list-title">新密码：<span> <input type="password" id="password"  class="span3" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password"></span></div>
				<div class="ear-list list-title">确认密码：<span><input type="password" id="repassword" class="span3" placeholder="请再次输入密码" recheck="password" errormsg="您两次输入的密码不一致" nullmsg="请填确认密码" datatype="*" name="repassword"></span></div>
				
				<div class="btn-box">
					 <div type="submit" id="submit" class="amend-btn">提 交</div>
					 <div type="submit" class="amend-btn" onclick="history.go(-1)">返 回</div>
				</div>
	        </form>
		</div>
		
	<script src="/../static//demo/js/jquery.js"></script>
   	<script type="text/javascript" src="/../static//demo/layer/layer.js"></script>
	<script src="/../static//demo/js/touchFeedback.js"></script>
	<script src="/../static//demo/js/js.js"></script>
	<script src="/../static//demo/js/app.js"></script>		
		
		
		<script>
			$('#submit').click(function(){
				var old=$('#old').val();
				var password=$('#password').val();
				var repassword=$('#repassword').val();
				if(old==''){
					$('#old').focus();
		            layer.msg('原密码不能为空！');
			        return ;
				}
				if(password==''){
					$('#password').focus();
		            layer.msg('新密码不能为空！');
			        return ;
				}
				if(password.length<6||password.length>20){
					$('#password').focus();
		            layer.msg('新密码的长度为6-20位！');
			        return ;
				}

				if(repassword==''){
					$('#repassword').focus();
		            layer.msg('确认密码不能为空！');
			        return ;
				}
				if(repassword.length<6||repassword.length>20){
					$('#repassword').focus();
		            layer.msg('确认密码的长度为6-20位！');
			        return ;
				}
				if(password!=repassword){
					$('#password').focus();
		            layer.msg('您输入的新密码与确认密码不一致');
			        return ;
				}
				$.post(
				"<?php echo url('api/user/pwd_edit_post'); ?>",
				{old_pwd:old,pwd:password,confirm_pwd:repassword},
				function(data){
					if(data.status==1){
						layer.msg(data.msg);
//						setTimeout(function(){
//							window.location.href="<?php echo url('user/personal'); ?>";
//						},1500)
					}else{
						layer.msg(data.msg);
					}
				},'json')
			});
			
	$(function(){
		$.post(
			"<?php echo url('api/User/edit'); ?>",
			{a:'value1',b:'value2'},
			function(data){
				if(data.status==1){
					console.log(data);
					var list=data.data;
					console.log(list.username);
					$(".username").text(list.username);
					$(".nickname").text(list.nickname);
					$(".phone").text(list.phone);
					$(".weixin").text(list.weixin);
					$(".last_login_time").text(list.last_login_time);
					
				}else{
					layer.msg("信息获取失败");
				}
		},'json');
    });	
		</script>

	</body>
</html>