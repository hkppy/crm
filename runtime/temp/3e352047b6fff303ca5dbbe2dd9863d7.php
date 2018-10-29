<?php /*a:2:{s:78:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\article\index.html";i:1540439960;s:83:"C:\phpStudy2018\PHPTutorial\WWW\tp5.1\application\demo\view\public\header_menu.html";i:1539738244;}*/ ?>
<!DOCTYPE html>
<title>淮南麻将推广管理平台</title>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="wap-font-scale" content="no">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <link href="/../static//Home/css/detail.css" rel="stylesheet" type="text/css">
		<link href="/../static//Home/css/style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/../static//Home/js/jquery-1.10.2.min.js"></script>
   		<script type="text/javascript" src="/../static//Home/layer/layer.js"></script>
		<script src="/../static//Home/js/touchFeedback.js"></script>
		<script src="/../static//Home/js/js.js"></script>
</head>
<body>
<div class="header">
    商户管理后台
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
        <div class="earning">
            <ul class="tabs" id="tabs">
                <!-- <li><a href="javascript:void(0);" title="tab1" class="activite">代理活动</a></li> -->
                <li><a href="javascript:void(0);" title="tab2">代理公告</a></li>
            </ul>
            <div class="ear-content" id="ear-content">
                <!-- 代理活动 -->
                <!-- <div class="withdraw" id="tab1">
                    <div class="ear-list list-title no-bod">代理活动</div>
                        <div class="record" id="activity">
                                <table>
                                    <tr>
                                        <th>活动名称</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                    </tr>
                                    <tr>
                                        <td>充值多送</td>
                                        <td>2017/09/12 10:20:35</td>
                                        <td>2017/09/30 10:20:35</td>
                                    </tr>
                                </table>
                        </div>
                </div> -->
                <!-- 代理公告 -->
                <div class="withdraw" id="tab2">
                        <div class="ear-list list-title no-bod">活动公告</div>
                        <div class="record" id="notice">
                                <table>
                                    <tr>
                                        <th>公告名称</th>
                                        <th>发布时间</th>
                                    </tr>
 
                                </table>
                        </div>
                </div>

            </div>
        </div>
</div>
</body>
<script>

    $('#tuichu').click(function(){
        $.post(
            "<?php echo url('User/logout'); ?>",
            {},
            function(data){
                if(data.status==1){
                    layer.msg("退出成功");
                    setTimeout(function () {
                    window.location.href="<?php echo url('User/login'); ?>";
                    }, 1000);
                }else{
                    layer.msg("退出失败");
                }
        },'json');
    })

    /*   $(function(){
    var counter = 0;
    // 每页展示4个
    var num = 4;
    var pageStart = 0,pageEnd = 0;

    // dropload
    $('#activity').dropload({
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
                url: 'json/activity.json',
                dataType: 'json',
                success: function(data){
                    var result = '';
                    counter++;
                    pageEnd = num * counter;
                    pageStart = pageEnd - num;

                   for(var i = pageStart; i < pageEnd; i++){
                    result+="<tr><td>"+data.lists[i].activityname+"</td><td>"+data.lists[i].starttime+"</td><td>"+data.lists[i].endtime+"</td></tr>";

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
                        $("#activity table").append(result);
                        // 每次数据加载完，必须重置
                           me.resetload();
                    },1000);
                },
                error: function(xhr, type){
                    alert('Ajax error!');
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        threshold : 50
    });
});
      $(function(){
    var counter = 0;
    // 每页展示4个
    var num = 4;
    var pageStart = 0,pageEnd = 0;

    // dropload
    $('#notice').dropload({
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
                url: 'json/notice.json',
                dataType: 'json',
                success: function(data){
                    var result = '';
                    counter++;
                    pageEnd = num * counter;
                    pageStart = pageEnd - num;

                   for(var i = pageStart; i < pageEnd; i++){
                    result+="<tr><td>"+data.lists[i].activityname+"</td><td>"+data.lists[i].starttime+"</td></tr>";

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
                        $("#notice table").append(result);
                        // 每次数据加载完，必须重置
                           me.resetload();
                    },1000);
                },
                error: function(xhr, type){
                    alert('Ajax error!');
                    // 即使加载出错，也得重置
                    me.resetload();
                }
            });
        },
        threshold : 50
    });
});*/
</script>
</html>