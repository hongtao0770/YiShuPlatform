<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>易书图书后台管理系统</title>
    <link rel="stylesheet" href="/YiShuBookPlatform/service/Api/Public/css/admin.css">
    <link rel="stylesheet" href="/YiShuBookPlatform/service/Api/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="/YiShuBookPlatform/service/Api/Public/layui/layui.js"></script>
</head>
<body>
<div class="header">
    <h2 class="z cl"><a href="<?php echo U('index/index');?>"><img src="/YiShuBookPlatform/service/Api/Public/img/书图标.png " style="height: 50px">易书图书后台管理系统</a></h2>
</div>
<div class="admin">
    <div class="aleft">
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe643;</i>操作菜单</h3>
        <ul class="cl">
            <li><i class="icon ion-android-list"></i><a href="<?php echo U('book/index');?>"> 图书管理</a></li>
            <li><i class="icon ion-android-clipboard"></i><a href="<?php echo U('oldbook/index');?>"> 二手书管理</a></li>
            <li><i class="icon ion-person-add"></i><a href="<?php echo U('user/index');?>"> 用户管理</a></li>
            <li><i class="icon ion-chatbox-working"></i><a href="<?php echo U('Commont/index');?>"> 评论管理</a></li>
            <li><i class="icon ion-compose"></i></i><a href="<?php echo U('Order/index');?>"> 订单管理</a></li>
            <li><i class="icon ion-leaf"></i><a href="<?php echo U('Activity/index');?>"> 活动管理</a></li>
            <li><i class="icon ion-android-checkbox-outline"></i><a href="#">审核管理</a></li>
            <li><i class="icon ion-aperture"></i><a href="<?php echo U('friend/index');?>"> 书友圈管理</a></li>
        </ul>
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe614;</i>系统管理</h3>
        <ul class="cl">
            <li><i class="icon ion-settings"></i><a href="<?php echo U('Password/index');?>"> 密码修改</a></li>
            <li><i class="icon ion-reply-all"></i><a href="<?php echo U('Login/logout');?>"> 立即退出</a></li>
        </ul>

    </div>
<div class="aright">
    <!--<div class="arz cl"><a href="<?php echo U('friend/add');?>"><i class="layui-icon">&#xe608;</i>添加动态</a></div>-->

    <form method="post" class="aform cl">
        <table width="100%">
            <tr>
                <th width="10%" align="center">评论编号</th>
                <th width="30%" align="center">评论内容</th>
                <th width="10%" align="center">评论动态ID</th>
                <th width="10%" align="center">用户ID</th>
                <th width="10%" align="center">基本操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><?php echo ($vo["commonid"]); ?></td>
                    <td align="center"><?php echo ($vo["commoncontent"]); ?></td>
                    <td align="center"><?php echo ($vo["fid"]); ?></td>
                    <td align="center"><?php echo ($vo["userid"]); ?></td>
                    <td align="center">
                        <a href="<?php echo U('commont/edit',array('commonid'=>$vo['commonid']));?>">修改</a>
                        <a href="<?php echo U('commont/delete',array('commonid'=>$vo['commonid']));?>" onclick="return confirm('您确定要删除吗？');">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </form>
    <div class="pages">
        <?php echo ($page); ?>
    </div>
</div>
</div>
</body>
</html>