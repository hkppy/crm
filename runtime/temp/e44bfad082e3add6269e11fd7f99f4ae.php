<?php /*a:1:{s:76:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\login\login.html";i:1540439672;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="wap-font-scale" content="no">
    <title>客户管理系统0.1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <link href="/../static//demo/css/detail.css" rel="stylesheet" type="text/css">
    <link href="/../static//demo/css/style.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="header">
    客户管理系统
</div>
<div class="container">
    <form action="" class="login-form">
        <div class="title">客户管理系统</div>
        <div class="user login-list">
            <label><i class="iconfont icon-yonghu"></i> 账号</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="password login-list" >
            <label><i class="iconfont icon-mima"></i> 密码</label>
            <input type="password" id="password" name = "password">            
        </div>
        <div class="yzm login-list">
            <label><i class="iconfont icon-yzm"></i> 验证码</label>
            <input type="text">    
            <span class="yzm-img">
               <div><?php echo captcha_img(); ?></div>
            </span>        
        </div>
        <!--<div class="deal">
            <input type="checkbox" checked="checked" disabled="disabled">
            <span>同意《合作协议》</span>
        </div>-->
        
        
        <div class="btn" id="login">登录</div>
        <div class="forget">
            <!--<a href="<?php echo url('User/register'); ?>" class="lf">代理注册</a>-->
            <!-- <a href="" class="rt">忘记密码?</a>             -->
        </div>
    </form>

    
    

</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="/../static//layer_mobile/layer.js"></script>

<script>
	$(function() {

		$('#login').click(function() {

			if($("#username").val() == '') {
				//alert('用户名不能为空！');
				//layer.msg('用户名不能为空！');
				alert_msg('用户名不能为空',3)
				return false;
			}

			if($("#username").val() == '') {
				//alert('密码不能为空！');
				//layer.msg('密码不能为空！');
				alert_msg('密码不能为空',3)
				return false;
			}
			$.ajax({

				type: "POST",
				url: "<?php echo url('api/login/login_check'); ?>",
				data: {
					username: $("#username").val(),
					password: $("#password").val()
				},

				success: function(data) {
					console.log(data);
					if(data.code == 1) {
						alert_msg(data.msg,3)
						window.location.href = "<?php echo url('index/index'); ?>";
					} else {
						alert_msg(data.msg,3)
						
					}
				}

			});

		});

	});
	
	function alert_msg(msg,time){
		  layer.open({
		    content: msg
		    ,style: 'background-color:#09C1FF; color:#fff; border:none;' //自定风格
		    ,skin: 'msg'
		    ,time: time //2秒后自动关闭
		  });
	}
	
	
	
	
	
	
</script>