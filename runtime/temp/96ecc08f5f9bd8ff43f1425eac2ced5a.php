<?php /*a:3:{s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\shopping\edit.html";i:1539829015;s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header.html";i:1539669711;s:83:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header_menu.html";i:1539738244;}*/ ?>
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
<link href="/../static//demo/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
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
			<input type="hidden" name="id" value="<?php echo htmlentities($id); ?>">
			
			<div class="agent">
				<div class="agent-title">修改客户消费信息</div>

					
				<div class="ear-list list-title"><span class="span1">商品名称：</span>
					<span> <input type="text" id="q"  class="span3" name="q" placeholder="输入商品名称搜索"  ></span>
				</div>
				
				<div class="ear-list list-title">
					
					<span class="span1">未选择商品信息：</span>
					
				<div style="height: 50px;font-size: 0.9rem;padding-bottom: 10px;line-height: 30px;" id="goods1">
					
				</div>	
				</div>

				<div class="ear-list list-title">
					
					<span class="span1">已选择商品信息：</span>
					
				<div style="min-height: 50px;font-size: 0.9rem;padding-bottom: 10px;line-height: 30px;" id="goods2">
					
				</div>	
				</div>
				
				<div class="ear-list list-title"><span class="span1"  >收件信息：</span>
					<span> <input type="text" id="q2" class="span3" placeholder="输入收件人姓名电话搜索" name="q2"  ></span>
				</div>
				<div class="ear-list list-title">
					
					<span style="display: inline-block; font-size: 0.9rem">未选择收件人信息：</span>
					
				<div style="min-height: 50px;font-size: 0.9rem;padding-bottom: 10px;line-height: 30px;" id="address1">
					
				</div>	
				</div>
				
				<div class="ear-list list-title">
					
					<span  style="display: inline-block; font-size: 0.9rem">已选择收件人信息：</span>
					
				<div style="min-height: 50px;font-size: 0.9rem;padding-bottom: 10px;line-height: 30px;" id="address2">
					
				</div>	
				</div>
				
				<div class="ear-list list-title"><span class="span1">总金额：</span>
					<span> <input type="text"  class="span3" name="pay_amount" readonly="readonly" id="pay_amount" placeholder="由系统自动结算不需要填写" ></span>
				</div>

				<div class="ear-list list-title"><span class="span1">客户备注：</span>
					<span><input type="text"  class="span3" name="notes" id="notes" placeholder="选填" ></span></div>
				
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
				url: "<?php echo url('api/shopping/add_post'); ?>",
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
<script type="text/javascript">
	$("#q").keyup(function() {
		$("#fdkhdsjk").empty();
		var q=$("#q").val();
		console.log(q);
			$.ajax({
			type: 'POST',
			url: "<?php echo url('api/goods/search_goods'); ?>",
			data: {'q':q},
			dataType: 'json',
			success: function(data){
				console.log(data);
				
				if(data.status=='1'){
					//console.log(data.data['0']);
					var res = data.data
            		var len = res.length;
            		//console.log(res);
					//console.log(len);
					//console.log(data.data);
					var cm='';
					
					for(var i = 0; i < len; i++){
						
						cm += "产品名称："+res[i]["goods_name"]+"&nbsp;&nbsp;单价："+res[i]["goods_price"]+"&nbsp;&nbsp;数量："+res[i]["goods_num"];
					 	cm += "&nbsp;&nbsp;<a href='javascript:void(0);' class='registerVari' onclick='js_goods_add(this)'"; 
					 	cm += "data-fruit='"+JSON.stringify(data.data[i])+"'"; 
						cm += "data-array='"+JSON.stringify(data.data[i])+"'>";
						cm += "<i class='Hui-iconfont'>&#xe600;</i></a>";
					 	cm += "</br>";
					}
					
					$('#goods1').html(cm);

					layer.msg('查询成功!',{icon: 1,time:1000});
				}else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	
	

		
		//$("#goods_price").css("background-color", "#FFFFCC");
	});
</script>
<script type="text/javascript">
function js_goods_add(obj){
	//console.log(obj);
	//console.log(obj.getAttribute('data-fruit'))
	var list=obj.getAttribute('data-fruit');
	var str_array=obj.getAttribute('data-array');
	
	console.log(str_array);
	console.log("正确的JSON");
	
	var jsobject = jQuery.parseJSON(str_array);//转化
	console.log(jsobject.goods_num);
	console.log(jsobject.goods_price);
	var menoy=jsobject.goods_price*jsobject.goods_num;

	
	var pay_amount=Number($("#pay_amount").val());
	
	var new_pay_amount=pay_amount+menoy;
	
	$("#pay_amount").val(new_pay_amount);
	console.log(pay_amount);
	
	var html="<a href='javascript:void(0);' class='registerVari' onclick='js_goods_del(this)' data-ids='"+str_array+"' ><input type='text' class='input-text' style=' width:80%' name='goods_list[]' value='"+list+"'>&nbsp;&nbsp;<i class='Hui-iconfont'>&#xe6a1;</i></a>";
	$("#goods2").append(html);
}
</script>
<script type="text/javascript">
function js_goods_del(obj){
	var str_array=obj.getAttribute('data-ids');
	
	console.log(str_array);
	console.log("正确的JSON");
	
	var jsobject = jQuery.parseJSON(str_array);//转化
	console.log(jsobject.goods_num);
	console.log(jsobject.goods_price);
	var menoy=jsobject.goods_price*jsobject.goods_num;
	var pay_amount=Number($("#pay_amount").val());
	
	var new_pay_amount=pay_amount-menoy;
	
	$("#pay_amount").val(new_pay_amount);
	console.log(pay_amount);
	console.log(obj);
	obj.remove();
}
</script>



<script type="text/javascript">
function js_goods_del(obj){
	var str_array=obj.getAttribute('data-ids');
	
	console.log(str_array);
	console.log("正确的JSON");
	
	var jsobject = jQuery.parseJSON(str_array);//转化
	console.log(jsobject.goods_num);
	console.log(jsobject.goods_price);
	var menoy=jsobject.goods_price*jsobject.goods_num;
	var pay_amount=Number($("#pay_amount").val());
	
	var new_pay_amount=pay_amount-menoy;
	
	$("#pay_amount").val(new_pay_amount);
	console.log(pay_amount);
	console.log(obj);
	obj.remove();
}
</script>




<script type="text/javascript">
	$("#q2").keyup(function() {
		$("#address1").empty();
		var q=$("#q2").val();
		console.log(q);
			$.ajax({
			type: 'POST',
			url: "<?php echo url('api/goods/search_address'); ?>",
			data: {'q':q},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.status=='1'){
					var res = data.data
            		var len = res.length;
            		console.log(res);
					console.log(len);
					console.log(data.data);
					var cm='';
					for(var i = 0; i < len; i++){
						cm += JSON.stringify(data.data[i]);
					 	cm += "&nbsp;&nbsp;<a href='javascript:void(0);' class='registerVari' onclick='js_address_add(this)' data-fruit='"+JSON.stringify(data.data[i])+"' ><i class='Hui-iconfont'>&#xe600;</i></a>";
					 	cm += "</br>";
					 	
					}
					
					$('#address1').html(cm);
					layer.msg('查询成功!',{icon: 1,time:1000});
				}else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	
	

		
		//$("#goods_price").css("background-color", "#FFFFCC");
	});
</script>

<script type="text/javascript">
function js_address_add(obj){
	console.log(obj);
	console.log(obj.getAttribute('data-fruit'))
	var list=obj.getAttribute('data-fruit');
	//alert($("input[name='address_list[]']").length);
	var address_num=$("input[name='address_list[]']").length;
	if(address_num >='1'){
		layer.msg("地址默认只能选择一条",{icon:2,time:1000});
		return false;
	}else{
		var html="<a href='javascript:void(0);' class='registerVari' onclick='js_address_del(this)'><input type='text' class='input-text' style='width:80%' name='address_list[]' id='address_list' value='"+list+"'>&nbsp;&nbsp;<i class='Hui-iconfont'>&#xe6a1;</i></a>";
		$("#address2").append(html);
	}
	
	
}
</script>


<script type="text/javascript">
function js_address_del(obj){
	console.log(obj);
	obj.remove();
}
</script>


<script>

			
	$(function(){
		$.post(
			"<?php echo url('api/shopping/edit'); ?>",
			{id:'<?php echo htmlentities($id); ?>'},
			function(data){
				if(data.status==1){
					console.log(data);
					var list=data.data;
					$("#pay_amount").val(list.pay_amount);
					$("#notes").val(list.notes);
	                var html="<a href='javascript:void(0);' class='registerVari' onclick='js_address_del(this)'><input type='text' class='input-text' style='width:80%' name='address_list[]' id='address_list' value='"+list.expinfo+"'>&nbsp;&nbsp;<i class='Hui-iconfont'></i></a>";
					$("#address2").append(html);
					
					var cm='';
					for(var i = 0; i < list.expinfo.length; i++){
						cm+="<a href='javascript:void(0);' class='registerVari' onclick='js_goods_del(this)' data-ids='"+list.goods[i]+"'><input type='text' class='input-text' style=' width:80%' name='goods_list[]' value='"+list.goods[i]+"'>&nbsp;&nbsp;<i class='Hui-iconfont'></i></a>";
					}
					$("#goods2").append(cm);
					
					
					
					
				}else{
					layer.msg("信息获取失败");
				}
		},'json');
    });	
		</script>
