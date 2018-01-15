<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tpt-Blog博客管理系统</title>
    <link rel="stylesheet" href="/thinkphp_3.2.3_full/Public/css/admin.css">
    <link rel="stylesheet" href="/thinkphp_3.2.3_full/Public/layui/css/layui.css">
    <script src="/thinkphp_3.2.3_full/Public/layui/layui.js"></script>
</head>
<body>
<div class="header">
    <h2 class="z cl"><a href="<?php echo U('index/index');?>"><img src="/thinkphp_3.2.3_full/Public/img/logo.png"></a></h2>
    <div class="y cl">
        <a target="_blank" href="/thinkphp_3.2.3_full/index.php">网站首页</a>
        <a href="<?php echo U('Login/logout');?>">退出</a>
    </div>
</div>
<div class="admin">
    <div class="aleft">
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe643;</i>操作菜单</h3>
        <ul class="cl">
            <li><i class="layui-icon">&#xe601;</i><a href="<?php echo U('navtop/index');?>">导航管理</a></li>
            <li><i class="layui-icon">&#xe61f;</i><a href="<?php echo U('Category/index');?>">栏目管理</a></li>
            <li><i class="layui-icon">&#xe63c;</i><a href="<?php echo U('article/index');?>">文章管理</a></li>
            <li><i class="layui-icon">&#xe60c;</i><a href="<?php echo U('banner/index');?>">幻灯管理</a></li>
            <li><i class="layui-icon">&#xe64e;</i><a href="<?php echo U('links/index');?>">友情连接</a></li>
        </ul>
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe614;</i>系统管理</h3>
        <ul class="cl">
            <li><i class="layui-icon">&#xe62c;</i><a href="<?php echo U('conf/index');?>">网站配置</a></li>
            <li><i class="layui-icon">&#xe631;</i><a href="<?php echo U('Member/index');?>">密码修改</a></li>
            <li><i class="layui-icon">&#xe640;</i><a href="<?php echo U('runtime/index');?>">清理缓存</a></li>
            <li><i class="layui-icon">&#x1006;</i><a href="<?php echo U('Login/logout');?>">立即退出</a></li>
        </ul>
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #009688;">&#xe612;</i>帮助中心</h3>
        <ul class="cl">
            <li><i class="layui-icon">&#xe63a;</i><a target="_blank" href="http://www.tpt360.com/">官方网站</a></li>
        </ul>
    </div>
<div class="aright">

    <div class="arz cl"><a href="<?php echo U('category/add');?>"><i class="layui-icon">&#xe608;</i>添加栏目</a></div>
    <form method="post" class="aform cl">
        <table width="100%">
            <tr>
                <th width="10%" align="center">栏目编号</th>
                <th width="20%" align="center">栏目名称</th>
                <th width="10%" align="center">栏目类型</th>
                <th width="20%" align="center">栏目图片</th>
                <th width="20%" align="center">添加时间</th>
                <th width="20%" align="center">基本操作</th>
            </tr>
            <?php if(is_array($c)): foreach($c as $k=>$vo): ?><tr>
                    <td align="center"><?php echo ($vo["id"]); ?></td>
                    <td style="padding-left: 20px;"><a target="_blank" href="/thinkphp_3.2.3_full/index.php?m=Home&c=index&a=category&id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a></td>
                    <td align="center">
                        <?php if($vo['type'] == 1): ?>文章<?php endif; ?>
                        <?php if($vo['type'] == 2): ?>产品<?php endif; ?>
                    </td>
                    <td align="center"><?php if($vo['pic'] != ''): ?><img src="/thinkphp_3.2.3_full/Uploads<?php echo ($vo["pic"]); ?>" height="30"><?php else: ?>暂无图片<?php endif; ?></td>
                    <td align="center"><?php echo (date("Y-n-d",$vo["time"])); ?></td>
                    <td align="center">
                        <a href="<?php echo U('category/edit',array('id'=>$vo['id']));?>">修改</a> | <a href="<?php echo U('category/delete',array('id'=>$vo['id']));?>" onclick="return confirm('您确定删除吗？');">删除</a>
                    </td>
                </tr>
                <?php if(is_array($cs)): foreach($cs as $k=>$vs): if($vo["id"] == $vs['tid']): ?><tr>
                            <td align="center"><?php echo ($vs["id"]); ?></td>
                            <td style="padding-left: 20px;">———— <a target="_blank" href="/thinkphp_3.2.3_full/index.php?m=Home&c=index&a=category&id=<?php echo ($vs["id"]); ?>"><?php echo ($vs["name"]); ?></a></td>
                            <td align="center">
                                <?php if($vs['type'] == 1): ?>文章<?php endif; ?>
                                <?php if($vs['type'] == 2): ?>产品<?php endif; ?>
                            </td>
                            <td align="center"><?php if($vs['pic'] != ''): ?><img src="/thinkphp_3.2.3_full/Uploads<?php echo ($vs["pic"]); ?>" height="30"><?php else: ?>暂无图片<?php endif; ?></td>
                            <td align="center"><?php echo (date("Y-n-d",$vs["time"])); ?></td>
                            <td align="center">
                                <a href="<?php echo U('category/edit',array('id'=>$vs['id']));?>">修改</a> | <a href="<?php echo U('category/delete',array('id'=>$vs['id']));?>" onclick="return confirm('您确定删除吗？');">删除</a>
                            </td>
                        </tr><?php endif; endforeach; endif; endforeach; endif; ?>
        </table>
    </form>
</div>
</div>
</body>
</html>