<?php /*a:3:{s:93:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\customer\customer_shop_edit.html";i:1540452613;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540782757;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
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
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($list['id']); ?>">
		
		<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						所属客户：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						
						<select class="select" size="1" id="cid" name="cid">
							<option value="" selected>请选择所属客户</option>
							<?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo htmlspecialchars($vo['id']); ?>" <?php if($vo['id'] == $list['cid']): ?>selected="selected"<?php endif; ?>><?php echo htmlspecialchars($vo['realname']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						
						</span>
					</div>
					<div class="col-3">
					</div>
		</div>
		
		
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3" style="font-weight: 700; font-family: Microsoft YaHei;"><span class="c-red">*</span>总金额：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo htmlspecialchars($list['pay_amount']); ?>" placeholder="此处由系统自动结算，不用填写" readonly="readonly"  id="pay_amount" name="pay_amount">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3" style="font-weight: 700; font-family: Microsoft YaHei;"><span class="c-red">*</span>收件信息：</label>
			<div class="formControls col-xs-8 col-sm-8" >
				<input type="text" class="input-text"  placeholder="输入姓名或者地址搜索" id="q" name="q" class="">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">未选中</label>
			<div class="formControls col-xs-8 col-sm-8" >
			<div class="input-text" id="dshjkkl"  style="overflow: auto;height: 100px;">
				
			</div>
			</div>
			
			
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">已选中</label>
			<div class="formControls col-xs-8 col-sm-8" >
			<div style="overflow: auto;height: 100px;box-sizing: border-box; border: solid 1px #ddd;" id="addressxzlist" >
				
					<?php if(!(empty($list['address_list']) || (($list['address_list'] instanceof \think\Collection || $list['address_list'] instanceof \think\Paginator ) && $list['address_list']->isEmpty()))): ?>
					<a href="javascript:void(0);" class="registerVari"  onclick="js_address_del(this)" data-ids="<?php echo htmlspecialchars($list['address_list']); ?>">
					<input type="text" class="input-text" style="width:80%" name="address_list[]" value="<?php echo htmlspecialchars($list['address_list']); ?>">&nbsp;&nbsp;<i class="Hui-iconfont"></i>
					</a>
					<?php endif; ?>
				
			</div>
			</div>
			
			
		</div>

		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3" style="font-weight: 700; font-family: Microsoft YaHei;"><span class="c-red">*</span>订单产品信息：</label>
			<div class="formControls col-xs-8 col-sm-8">
				<input type="text" class="input-text"  placeholder="输入商品名称搜索" id="g" name="g">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">未选中</label>
			<div class="formControls col-xs-8 col-sm-8" >
			<div class="input-text"  style="height: 150px;" id="fdkhdsjk">
				
			</div>
			</div>
			
			
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">已选中</label>
			<div class="formControls col-xs-8 col-sm-8" style="overflow: auto;height: 150px;">
			<div class="input-text"  style="height: 150px;" id="xzlist">
				
				<?php if(!(empty($list2) || (($list2 instanceof \think\Collection || $list2 instanceof \think\Paginator ) && $list2->isEmpty()))): foreach($list2 as $key=>$vo): ?> 
					<a href="javascript:void(0);" class="registerVari" onclick="js_goods_del(this)" data-ids="<?php echo htmlspecialchars($vo); ?>">
					<input type="text" class="input-text" style="width:80%" name="goods_list[]" value="<?php echo htmlspecialchars($vo); ?>" >&nbsp;&nbsp;<i class="Hui-iconfont"></i>
					</a>
				<?php endforeach; endif; ?>
				
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
			name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			goods_title:{
				required:true,
				minlength:2,
				maxlength:16
			},
			
		},
		messages: {
			name: {
		        required: "请输入姓名",
		        minlength: "姓名名必需由两个字母组成"
		    },
		   	goods_title: {
		        required: "请输入商品名称",
		        minlength: "商品名称必需由两个字母组成"
		    },
			
		},	
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php echo url('customer_shop_edit_post'); ?>" ,
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

<script type="text/javascript">
	$("#q").keyup(function() {
		$("#dshjkkl").empty();
		var q=$("#q").val();
		console.log(q);
			$.ajax({
			type: 'POST',
			url: "<?php echo url('goods/search_address'); ?>",
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
					
					$('#dshjkkl').html(cm);
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
	$("#g").keyup(function() {
		$("#fdkhdsjk").empty();
		var q=$("#g").val();
		console.log(q);
			$.ajax({
			type: 'POST',
			url: "<?php echo url('goods/search_goods'); ?>",
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
					
					$('#fdkhdsjk').html(cm);

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
	console.log("添加收货地址");
	console.log(obj.getAttribute('data-fruit'))
	var list=obj.getAttribute('data-fruit');
	//alert($("input[name='address_list[]']").length);
	var address_num=$("input[name='address_list[]']").length;
	if(address_num >='1'){
		layer.msg("地址默认只能选择一条",{icon:2,time:1000});
		return false;
	}else{
		var html="<a href='javascript:void(0);' class='registerVari' onclick='js_address_del(this)'><input type='text' class='input-text' style='width:80%' name='address_list[]' value='"+list+"'>&nbsp;&nbsp;<i class='Hui-iconfont'>&#xe6a1;</i></a>";
		$("#addressxzlist").append(html);
	}
	
	
}
</script>

<script type="text/javascript">
function js_goods_add(obj){
	//console.log(obj);
	//console.log(obj.getAttribute('data-fruit'))
	var list=obj.getAttribute('data-fruit');
	var str_array=obj.getAttribute('data-array');
	
	console.log(str_array);
	console.log("添加商品并计算商品总价");
	
	var jsobject = jQuery.parseJSON(str_array);//转化
	console.log(jsobject.goods_num);
	console.log(jsobject.goods_price);
	var menoy=jsobject.goods_price*jsobject.goods_num;

	
	var pay_amount=Number($("#pay_amount").val());
	
	var new_pay_amount=pay_amount+menoy;
	
	$("#pay_amount").val(new_pay_amount);
	console.log(pay_amount);
	
	var html="<a href='javascript:void(0);' class='registerVari' onclick='js_goods_del(this)' data-ids='"+str_array+"' ><input type='text' class='input-text' style=' width:80%' name='goods_list[]' value='"+list+"'>&nbsp;&nbsp;<i class='Hui-iconfont'>&#xe6a1;</i></a>";
	$("#xzlist").append(html);
}
</script>
<script type="text/javascript">
function js_address_del(obj){
	console.log("删除已选中的地址");
	//console.log(obj);
	obj.remove();
}
</script>
<script type="text/javascript">
function js_goods_del(obj){
	var str_array=obj.getAttribute('data-ids');
	
	console.log(str_array);
	console.log("删除已选中的商品");
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





<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>