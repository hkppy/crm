<?php /*a:2:{s:79:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\index\welcome.html";i:1540453828;s:82:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\admin\view\public\header_js.html";i:1540453180;}*/ ?>
﻿<!DOCTYPE HTML>
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
<meta name="keywords" content="<?php echo htmlspecialchars((isset($list['keywords']) && ($list['keywords'] !== '')?$list['keywords']:"这家伙很懒，什么也没留下")); ?>">
<meta name="description" content="<?php echo htmlspecialchars((isset($list['description']) && ($list['description'] !== '')?$list['description']:"这家伙很懒，什么也没留下")); ?>">
</head>




<body>
<div class="page-container">
	<p class="f-20 text-success">欢迎访问 用户名：<?php echo htmlspecialchars($login_user_list['user_login']); ?></p>
	<p>上次登录IP：<?php echo htmlspecialchars($login_user_list['last_login_ip']); ?>  上次登录时间：<?php echo htmlspecialchars(date('Y-m-d h:i:s',!is_numeric($login_user_list['last_login_time'])? strtotime($login_user_list['last_login_time']) : $login_user_list['last_login_time'])); ?></p>
	<!--<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>资讯库</th>
				<th>图片库</th>
				<th>产品库</th>
				<th>用户</th>
				<th>管理员</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td>92</td>
				<td>9</td>
				<td>0</td>
				<td>8</td>
				<td>20</td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
		</tbody>
	</table>-->
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">服务器信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th width="30%">服务器计算机名</th>
				<td><span id="lbServerName">http://<?php echo htmlspecialchars(app('request')->host()); ?></span></td>
			</tr>
			<tr>
				<td>服务器IP地址</td>
				<td><?php echo htmlspecialchars(app('request')->ip()); ?></td>
			</tr>
			<tr>
				<td>服务器域名</td>
				<td>http://<?php echo htmlspecialchars(app('request')->host()); ?></td>
			</tr>
			<tr>
				<td>服务器端口 </td>
				<td><?php echo htmlspecialchars(app('request')->port()); ?></td>
			</tr>

			<tr>
				<td>PHP版本 </td>
				<td><?php echo htmlspecialchars(PHP_VERSION); ?></td>
			</tr>
			<tr>
				<td>服务器操作系统 </td>
				<td><?php echo htmlspecialchars(app('request')->server('contentType')); ?></td>
			</tr>
			<tr>
				<td>系统所在文件夹 </td>
				<td><?php echo htmlspecialchars(app('request')->server('rootUrl')); ?></td>
			</tr>
		
		</tbody>
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
		<p>Copyright &copy;2018-2019 客户管理系统 All Rights Reserved.</p>
	</div>
</footer>

</body>
</html>