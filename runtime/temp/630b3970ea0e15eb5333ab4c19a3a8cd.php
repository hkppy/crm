<?php /*a:4:{s:79:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\customer\edit.html";i:1540965973;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540782757;s:92:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_column_title.html";i:1538040490;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\footer_js.html";i:1538015651;}*/ ?>
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
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 
	<?php if(isset($common_column_title['one_title'])): ?>
	<span class="c-gray en">&gt;</span> <?php echo htmlspecialchars($common_column_title['one_title']); endif; if(isset($common_column_title['two_title'])): ?>
	<span class="c-gray en">&gt;</span> <?php echo htmlspecialchars($common_column_title['two_title']); endif; ?>
	
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="form form-horizontal" >
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>消费记录</span>
				<span>基本信息</span>
				<span>更多信息</span>
				<!--<span>其他设置</span>-->
			</div>
<div class="tabCon">
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">

		<a href="javascript:;" onclick="seller_show('添加客户消费信息','<?php echo url('shop_add',array('cid'=>$list['id'])); ?>')"  class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe600;</i> 添加客户消费信息</a></span> 
		<span class="r">
		<a class="btn btn-success radius r" style="margin-left: 10px;line-height: 21px;" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont"></i></a>
		</span> 
		<span class="r" style="line-height: 27px;">共有数据：<strong><?php echo htmlspecialchars($count); ?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort" id="table-sort1">
		<thead>

			<?php if(session('group_id')=='1'): ?>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="20">ID</th>
				<th width="30">所属客户</th>
				<th width="30">总金额</th>
				<th width="200">收件信息</th>
				<th width="200">订单产品</th>
				<th width="130">备注</th>
				<th width="130">加入时间</th>
				<th width="50">是否软删除</th>
				<th width="100">操作</th>
			</tr>
			<?php else: ?>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="20">ID</th>
				<th width="30">所属客户</th>
				<th width="30">总金额</th>
				<th width="200">收件信息</th>
				<th width="200">订单产品</th>
				<th width="130">备注</th>
				<th width="130">加入时间</th>
				<th width="100">操作</th>
			</tr>
			<?php endif; ?>
			
		</thead>
		<tbody>
			<?php foreach($res as $key=>$vo): ?> 
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo htmlspecialchars($vo['id']); ?>" name=""></td>
				<td><?php echo htmlspecialchars($vo['id']); ?></td>
				<td><?php echo htmlspecialchars($vo['cid_name']); ?></td>
				<td>¥<?php echo htmlspecialchars($vo['pay_amount']); ?></td>
				<td class="text-l"><?php echo htmlspecialchars($vo['address_list']); ?></td>
				<td class="text-l"><?php echo htmlspecialchars($vo['goods_list']); ?></td>
				<td><?php echo htmlspecialchars($vo['notes']); ?></td>
				<td><?php echo htmlspecialchars(date('Y-m-d h:i:s',!is_numeric($vo['add_time'])? strtotime($vo['add_time']) : $vo['add_time'])); ?></td>
				<?php if(session('group_id')=='1'): if($vo['status'] == '0'): ?>
				    <td style="color: red;">已删除</td>
					<?php else: ?>
					 <td>未删除</td>
					<?php endif; endif; ?>
				
				<td class="td-manage"> 
					<a title="编辑" href="javascript:;" onclick="member_edit('编辑','<?php echo url('customer_shop_edit',array('id'=>$vo['id'])); ?>','4','800','600')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo htmlspecialchars($vo['id']); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a
				</td>
					
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

			<div style="" class="fenye"><?php echo $res; ?></div>
			</div>
		</div>
		</div>
			

			<div class="tabCon">
				<form action="" method="post" class="form form-horizontal" id="form-member-add">
					<input type="hidden" name="id" value="<?php echo htmlspecialchars($list['id']); ?>">

			<div class="row cl">
					<label class="form-label col-xs-4 col-sm-1">
						<span class="c-red">*</span>
						姓名：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo htmlspecialchars($list['realname']); ?>" placeholder="" id="realname" name="realname">
					</div>
			</div>
			<div class="row cl">
					<label class="form-label col-xs-4 col-sm-1">
						<span class="c-red">*</span>
						昵称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo htmlspecialchars($list['nickname']); ?>" placeholder="" id="nickname" name="nickname">
					</div>
			</div>
			<div class="row cl">
			<label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>联系方式：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input type="radio"  value="1" name="lxfs"  <?php if($list['lxfs'] == '1'): ?>checked="checked"<?php endif; ?>>
					<label for="sex-1">微信</label>
				</div>
				<div class="radio-box">
					<input type="radio" value="2" name="lxfs" <?php if($list['lxfs'] == '2'): ?>checked="checked"<?php endif; ?>>
					<label for="sex-2">QQ</label>
				</div>
				<div class="radio-box">
					<input type="radio" value="3" name="lxfs" <?php if($list['lxfs'] == '3'): ?>checked="checked"<?php endif; ?>>
					<label for="sex-3">手机</label>
				</div>
			</div>
			</div>	
			<div class="row cl">
					<label class="form-label col-xs-4 col-sm-1">
						<span class="c-red">*</span>
						联系号码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo htmlspecialchars($list['lxfs_value']); ?>" placeholder="" id="lxfs_value" name="lxfs_value">
					</div>
			</div>					


				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-1">
						<span class="c-red">*</span>
						密码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo htmlspecialchars($list['password']); ?>" placeholder="为空则不修改" id="password" name="password">
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-1">
						<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
					</div>
				</div>
			</form>
			</div>
			<div class="tabCon">
			<form class="form form-horizontal" id="form-admin-add2">
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
			<div class="row cl">
			<label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>生日历法：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input type="radio"  value="1" name="lifa"  <?php if($info['lifa'] == '1'): ?>checked="checked"<?php endif; ?>>
				<label for="sex-1">阳历</label>
			</div>
			<div class="radio-box">
				<input type="radio" value="2" name="lifa" <?php if($info['lifa'] == '2'): ?>checked="checked"<?php endif; ?>>
				<label for="sex-2">阴历</label>
				</div>
			</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>出生日期：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" autocomplete="off" id="birthday" name="birthday"  value="<?php if($info['birthday'] != ''): ?><?php echo htmlspecialchars(date('Y-m-d h:i:s',!is_numeric($info['birthday'])? strtotime($info['birthday']) : $info['birthday'])); endif; ?>">
				</div>
			</div>
	<script src="/../static/style/laydate/laydate.js"></script>
	<script>
	//执行一个laydate实例
	laydate.render({
	  elem: '#birthday' //指定元素
	  ,type: 'datetime'
	});
	</script>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-1"><span class="c-red">*</span>地址：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="<?php echo htmlspecialchars($info['address']); ?>" placeholder="" id="address" name="address">
		</div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-1">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="notes" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)"><?php echo htmlspecialchars($info['notes']); ?></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-1">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
	</div>

	</div>
		
	</div>
</div>

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
	$("#tab-system").Huitab({
		index:0
	});
		$("#form-member-add").validate({
		rules:{
			lxfs:{
				required:true,
			},
			lxfs_value:{
				required:true,
			}
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php echo url('editPost'); ?>" ,
				data: $('#form-member-add').serialize(), //将该表单序列化
				success: function(data){
					console.log(data);
					if(data.code==1){
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
	
		$("#form-admin-add2").validate({
		rules:{
			realname:{
				required:true,
				minlength:2,
				maxlength:10
			}
		},
		messages: {
			realname: {
				required: " (请输入姓名)",
				minlength: " (不能少于2 个字母)"
			}
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "<?php echo url('customer_show_Post'); ?>" ,
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
<script type="text/javascript">

/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}

function seller_show(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('shop_list_delete'); ?>",
			data: {'id':id},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.status=='1'){
					$(obj).parents("tr").remove();
				    layer.msg(data.msg,{icon:1,time:1000});
				}else{
					layer.msg(data.msg,{icon:2,time:1000});
				}
				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	
	});
}



</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
