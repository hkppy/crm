<?php /*a:3:{s:77:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\customer\add.html";i:1539680177;s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header.html";i:1539669711;s:83:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header_menu.html";i:1539738244;}*/ ?>
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

		<div class="container" style="font-size: 0.8rem;">
		<form action="" method="post" >
			<div class="agent">
				<div class="agent-title">添加客户</div>

				
				<div class="ear-list list-title"><span class="span1">联系方式：</span>
					<span> 
						<input type="radio" name="lxfs" value="1" style="display: inline-block;width: 1.5rem;height:24px;margin-top: 13px;" >QQ
						<input type="radio" name="lxfs" value="2" style="display: inline-block;width: 1.5rem;height:24px;margin-top: 13px;" >微信
						<input type="radio" name="lxfs" value="3" style="display: inline-block;width: 1.5rem;height:24px;margin-top: 13px;" >手机
					
					</span>
				</div>
					
				<div class="ear-list list-title"><span class="span1">联系号码：</span>
					<span> <input type="text"  class="span3" name="lxfs_value"  ></span>
				</div>
				

				<div class="ear-list list-title"><span class="span1" >密码：</span>
					<span> <input type="text"  class="span3" placeholder="选填" name="password"  ></span>
				</div>
				
				<div class="ear-list list-title"><span class="span1">姓名：</span>
					<span> <input type="text"  class="span3" name="realname"  placeholder="选填" ></span>
				</div>
				
				<div class="ear-list list-title"><span class="span1">生日历法：</span>
					<span> 
						<input type="radio" name="lifa" value="1" style="display: inline-block;width: 1.5rem;height:24px;margin-top: 13px;" >农历
						<input type="radio" name="lifa" value="2" style="display: inline-block;width: 1.5rem;height:24px;margin-top: 13px;" >阳历
					</span>
				</div>

				<div class="ear-list list-title"><span class="span1">出生日期：</span>
					<span> <input type="text"  class="span3" name="birthday"  ></span>
				</div>
				
				
				<div class="ear-list list-title"><span class="span1">详细地址：</span>
					<span> <input type="text"   class="span3" name="address"  placeholder="选填" ></span>
				</div>
				<div class="ear-list list-title"><span class="span1">客户备注：</span>
					<span><input type="text"  class="span3" name="notes"  placeholder="选填" ></span></div>
				
				<div class="btn-box">
					
					 <button type="button" id="btn" class="amend-btn" style="height: 45px;line-height: 45px;">提 交</button>
					 
					 <div type="submit" class="amend-btn" onclick="history.go(-1)" style="height: 45px;line-height: 45px;">返 回</div>
				</div>
	        </form>
		</div>
		
	<script src="/../static//demo/js/jquery.js"></script>
	
   	<script type="text/javascript" src="/../static//demo/layer/layer.js"></script>
	<script src="/../static//demo/js/touchFeedback.js"></script>
	<script src="/../static//demo/js/js.js"></script>
	<script src="/../static//demo/js/app.js"></script>		

 <script type="text/javascript">
	$(function() {
		
		$("#btn").click(function() {
			console.log($("form").serialize());
			$.post({
				url: "<?php echo url('api/customer/add_post'); ?>",
				data: $("form").serialize(),
				success: function(data) {
					
					if(data.status == 1) {
						layer.msg(data.msg,{icon:1,time:1000});
						} else {
							layer.msg(data.msg,{icon:2,time:1000});
						}
				}
			});

		});

	});
</script>	
<script>

			
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