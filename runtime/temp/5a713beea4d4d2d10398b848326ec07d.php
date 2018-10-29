<?php /*a:3:{s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\user\personal.html";i:1539669704;s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header.html";i:1539669711;s:83:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header_menu.html";i:1539738244;}*/ ?>
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
			<div class="agent">
				<div class="agent-title">个人信息</div>
				
				<div class="ear-list list-title">用户名：<span class="username"></span></div>
				<div class="ear-list list-title">昵称：<span class="nickname"></span></div>
				<div class="ear-list list-title">绑定手机：<span class="phone"></span></div>
				<div class="ear-list list-title">绑定微信：<span class="weixin"></span></div>
				<div class="ear-list list-title">最后登录时间：<span class="last_login_time"></span></div>
				
				<div class="amend-btn" data-touchFeedback="true">
					<a style="color:#fff" href="<?php echo url('User/profile'); ?>">修改密码</a>
				</div>
			</div>
		</div>
		


	</body>
</html>
	<script src="/../static//demo/js/jquery.js"></script>
   	<script type="text/javascript" src="/../static//demo/layer/layer.js"></script>
	<script src="/../static//demo/js/touchFeedback.js"></script>
	<script src="/../static//demo/js/js.js"></script>
	<script src="/../static//demo/js/app.js"></script>
	<script type="text/javascript">
	$('#tuichu').click(function(){
		$.post(
			"<?php echo url('api/login/logout'); ?>",
			{},
			function(data){
				if(data.status==1){
					layer.msg("退出成功");
                    setTimeout(function () {
                    window.location.href="<?php echo url('login/login'); ?>";
                    }, 1000);
				}else{
					layer.msg("退出失败");
				}
		},'json');
	})
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
