<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>YiShu图书管理平台</title>
    <link rel="stylesheet" href="/YiShu/Public/css/admin.css">
    <link rel="stylesheet" href="/YiShu/Public/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="/YiShu/Public/layui/layui.js"></script>
</head>
<body>
<div class="header">
    <h2 class="z cl"><a href="<?php echo U('index/index');?>"><img src="/YiShu/Public/img/booklogo.png"></a></h2>

    <div class="y cl">
        <li><a >易书图书管理平台</a></li>
    </div>
</div>
<div class="admin">
    <div class="aleft">
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe643;</i>操作菜单</h3>
        <ul class="cl">
            <li><i class="icon ion-navicon-round"></i><a href="<?php echo U('book/index');?>"> 图书管理</a></li>
            <li><i class="icon ion-person-add"></i><a href="<?php echo U('user/index');?>"> 用户管理</a></li>
            <li><i class="icon ion-star"></i><a href="<?php echo U('Category/index');?>"> 动态管理</a></li>
            <li><i class="icon ion-chatbox-working"></i><a href="<?php echo U('Comment/index');?>"> 评论管理</a></li>
            <li><i class="icon ion-compose"></i></i><a href="<?php echo U('Order/index');?>"> 订单管理</a></li>
            <li><i class="icon ion-leaf"></i><a href="<?php echo U('Activity/index');?>"> 活动管理</a></li>
            <li><i class="icon ion-search"></i><a href="<?php echo U('article/index');?>"> 图书审核</a></li>
            <li><i class="icon ion-aperture"></i><a href="<?php echo U('friend/index');?>"> 书友圈管理</a></li>
        </ul>
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe614;</i>系统管理</h3>
        <ul class="cl">
            <li><i class="icon ion-settings"></i><a href="<?php echo U('Password/index');?>"> 密码修改</a></li>
            <li><i class="icon ion-reply-all"></i><a href="<?php echo U('Login/logout');?>"> 立即退出</a></li>
        </ul>

    </div>
<div class="aright">
    <div class="arz cl"><a href="<?php echo U('book/add');?>"><i class="layui-icon">&#xe608;</i>添加图书</a></div>

    <form method="post" class="aform cl">
        <table width="100%">
            <tr>
                <th width="10%" align="center">图书编号</th>
                <th width="20%" align="center">图书名称</th>
                <th width="10%" align="center">图书价格</th>
                <th width="20%" align="center">图书封面</th>
                <th width="10%" align="center">是否打折</th>
                <th width="10%" align="center">首页推荐</th>
                <th width="20%" align="center">基本操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><?php echo ($vo["bookid"]); ?></td>
                    <td align="center"><?php echo ($vo["bookname"]); ?></td>
                    <td align="center"><?php echo ($vo["bookprice"]); ?></td>
                    <td align="center">
                        <?php if($vo[bookposter] != ''): ?><img src="/YiShu/Uploads<?php echo ($vo["bookposter"]); ?>" height="30">
                            <?php else: ?>
                            暂无封面<?php endif; ?>
                    </td>
                    <td align="center">
                        <?php if($vo['booksale'] == 1): ?>打折<?php endif; ?>
                        <?php if($vo['booksale'] == 0): ?>不打折<?php endif; ?>
                    </td>
                    <td align="center">
                        <?php if($vo['bookshow'] == 1): ?>首页推荐<?php endif; ?>
                        <?php if($vo['bookshow'] == 0): ?>不推荐<?php endif; ?>
                    </td>
                    <td align="center">
                        <a href="<?php echo U('book/edit',array('bookid'=>$vo['bookid']));?>">修改</a>
                        <a href="<?php echo U('book/delete',array('bookid'=>$vo['bookid']));?>" onclick="return confirm('您确定要删除吗？');">删除</a>
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