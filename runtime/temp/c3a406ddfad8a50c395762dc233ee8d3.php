<?php /*a:3:{s:79:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\customer\lists.html";i:1539825492;s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header.html";i:1539669711;s:83:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header_menu.html";i:1539738244;}*/ ?>
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
				<div class="agent-title"><span>客户管理</span> 
					<span style="float: right;margin-right: 1rem;font-size: 1.2rem;"><a href="<?php echo url('customer/add'); ?>">添加客户</a></span>
				</div>
				<div class="ear-list list-title">客户概况</div>
				<div class="ear-list overview">
					<div>
						<span>今日新增 </span>
						<span><strong  class="today_count">0</strong> 名</span>
						<i class="lf-bod"></i>
					</div>
					<div>
						<span>消费总额:</span>
						<span><strong  class="today_count_money">0</strong> 元</span>
					</div>
				</div>
				<div class="ear-list overview">
					<div>
						<span>本周新增: </span>
						<span><strong  class="week_count">0</strong> 名 </span>
						<i class="lf-bod"></i>
					</div>
					<div><span>消费总额: </span>
						<span><strong  class="week_count_money">0</strong> 元</span>
					</div>
				</div>
				<div class="ear-list overview">
					<div>
						<span>本月新增: </span>
						<span><strong  class="month_count">0</strong> 名</span>
						<i class="lf-bod"></i>
					</div>
					<div>
						<span>消费总额: </span>
						<span><strong  class="month_count_money">0</strong> 元</span>
					</div>
				</div>

				<div class="ear-list list-title ">客户搜索</div>
				<div class="ear-list wj-search">
					<input type="text"  name="wanjiaid" id="wanjiaid" placeholder="输入客户姓名/联系方式进行搜索" class="wj-search-input">
					<input type="submit" class="wj-search-btn" value="搜索" data-touchFeedback="true" >
				</div>

				
				 <div class="record recording" id="agent-game">
                                <table>
                                    <tr>
                                    	<th class="w10">ID</th>
                                        <th class="w10">姓名</th>
										<th class="w20">联系方式</th>
										<th class="w20">生日历法</th>
										<th class="w20">出生日期</th>
										<th class="w10">地址</th>
										<th class="w10">操作</th>
                                    </tr>

                                </table>
                </div>
				
			</div>
		</div>
	</body>
	<script src="/../static//demo/js/jquery.js"></script>
   	<script type="text/javascript" src="/../static//demo/layer/layer.js"></script>
	<script src="/../static//demo/js/touchFeedback.js"></script>
	<script src="/../static//demo/js/js.js"></script>
	<script src="/../static//demo/js/app.js"></script>
	<script src="/../static//demo/js/dropload.js"></script>
<script type="text/javascript">
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
    
    function user_edit(){
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
					//layer.msg("信息获取失败");
				}
		},'json');
    }
    
    $(function(){
		$.post(
			"<?php echo url('api/customer/customer_count_lists'); ?>",
			function(data){
				if(data.status==1){
					console.log(data);
					
					var list=data.data;
					
					$(".today_count").text(list.today_count);
					$(".week_count").text(list.week_count);
					$(".month_count").text(list.month_count);
					$(".today_count_money").text(list.today_count_money);
					$(".week_count_money").text(list.week_count_money);
					$(".month_count_money").text(list.month_count_money);
				}else{
					layer.msg("信息获取失败");
				}
		},'json');
    });

</script>

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
                    }, 500);
				}else{
					layer.msg("退出失败");
				}
		},'json');
	})
		
	
	</script>
</html>

<script>
    $(function(){
    var counter = 0;
    // 每页展示12个
    var num = 12;
    var pageStart = 0,pageEnd = 0;

    // dropload
    $('#agent-game').dropload({
        scrollArea : window,
        domDown : {
            domClass   : 'dropload-down',
            domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
            domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
            domNoData  : '<div class="dropload-noData">暂无数据</div>'
        },
        loadDownFn : function(me){
            $.ajax({
                type: 'GET',
                url: "<?php echo url('api/customer/lists'); ?>",
                dataType: 'json',
                success: function(data){
                	if(data.status=='1'){
                		
                	var result = '';
                    counter++;
                    pageEnd = num * counter;
                    pageStart = pageEnd - num;

                   for(var i = pageStart; i < pageEnd; i++){
                    result+="<tr>";
                    result+="<td>"+data.lists[i].id+"</td>";
                    result+="<td>"+data.lists[i].realname+"</td>";
                    result+="<td>"+data.lists[i].lxfs+"："+data.lists[i].lxfs_value+"</td>";
                    result+="<td>"+data.lists[i].lifa+"</td>";
                    result+="<td>"+data.lists[i].birthday+"</td>";
                    result+="<td>"+data.lists[i].address+"</td>";
                    result+="<td>";
                    result+="<a href='<?php echo url('customer/edit'); ?>?id="+data.lists[i].id+"'>修改</a>";
             		result+="<a href='<?php echo url('shopping/more'); ?>?id="+data.lists[i].id+"'>更多</a>";
             		result+="<a href='?id="+data.lists[i].id+"'>删除</a>";
                    result+="</td>";
                    
                    
                    
                    result+="</tr>";
                       if((i + 1) >= data.lists.length){
                            // 锁定
                            me.lock();
                            // 无数据
                            me.noData();
                            break;
                        }
                    }
					
                    // 为了测试，延迟1秒加载
                    setTimeout(function(){
                        $("#agent-game table").append(result);
                        // 每次数据加载完，必须重置
                           me.resetload();
                    },1000);
                    }
                   
                },
                error: function(xhr, type){
                    //alert('Ajax error!');
                    console.log('Ajax error!');
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        threshold : 50
    });
});
</script>

<script>
	function del(id = '') {
		if(confirm("确定删除数据")){
		$.post(
			"<?php echo url('api/customer/delete'); ?>",
			{'id':id},
			function(data) {
				if(data.status == 1) {
					console.log(data.msg);
					layer.msg(data.msg);
				} else {
					layer.msg(data.msg);
				}
			}, 'json');
		
		}
			
			
			
	}
</script>