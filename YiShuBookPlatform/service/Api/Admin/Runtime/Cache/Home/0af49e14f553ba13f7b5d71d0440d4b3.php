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
<script src="/thinkphp_3.2.3_full/Public/js/jquery-1.4.2.min.js"></script>
<div class="aright">
    <div class="arz" style="float: left;margin: 0px 20px 20px 30px;"><a href="<?php echo U('article/add');?>"><i class="layui-icon">&#xe608;</i>添加文章</a></div>

    <div style="float: left;">
        <form class="layui-form" action="/admin.php/article/index.html" method="get">
            <input placeholder="输入关键字" name="kw" value="<?php echo I('kw');?>" type="text" class="layui-input" style="float: left;margin-right: 10px;width: 300px;">
            <button class="layui-btn" style="float: left;" value="查询" type="submit">查询</button>
        </form>
    </div>

    <form method="post" class="aform cl" action="<?php echo U('article/deletes');?>">
        <table width="100%">
            <tr>
                <th width="5%" align="center"><input type="checkbox" name="checkbox" id="selall" /></th>
                <th width="5%" align="center">编号</th>
                <th width="25%" align="center">文章标题</th>
                <th width="10%" align="center">缩略图</th>
                <th width="10%" align="center">是否推荐</th>
                <th width="9%" align="center">是否精选</th>
                <th width="9%" align="center">所属栏目</th>
                <th width="9%" align="center">审核显示</th>
                <th width="9%" align="center">添加时间</th>
                <th width="9%" align="center">基本操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><input type="checkbox" class="selall" name="deletes[]" value="<?php echo ($vo["id"]); ?>" /></td>
                    <td align="center"><?php echo ($vo["id"]); ?></td>
                    <td align="center"><a target="_blank" href="/thinkphp_3.2.3_full/index.php?m=Home&c=index&a=article&id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>
                    <td align="center">
                        <?php if($vo[pic] != ''): ?><img src="/thinkphp_3.2.3_full/Uploads<?php echo ($vo["pic"]); ?>" height="30">
                            <?php else: ?>
                            暂无缩略图<?php endif; ?>
                    </td>
                    <td align="center"><?php if($vo[commend] == 1): ?><span style="color:#FF5722;">已推荐</span><?php else: ?>未推荐<?php endif; ?></td>
                    <td align="center"><?php if($vo[choice] == 1): ?><span style="color:#FF5722;">已精选</span><?php else: ?>未精选<?php endif; ?></td>
                    <td align="center"><?php if($vo[tid] == 0): ?><span style="color:#FF5722;">投稿栏目</span><?php else: echo ($vo["name"]); endif; ?></td>
                    <td align="center"><?php if($vo[open] == 0): ?><span style="color:#FF5722;">待审核</span><?php else: ?>显示<?php endif; ?></td>
                    <td align="center"><?php echo (date("Y-n-d",$vo["time"])); ?></td>
                    <td align="center"><a href="<?php echo U('article/edit',array('id'=>$vo['id']));?>">修改</a> | <a href="<?php echo U('article/delete',array('id'=>$vo['id']));?>" onclick="return confirm('您确定要删除吗？');">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="layui-form-item">
            <div style="margin-top: 20px;">
                <button class="layui-btn" onclick="return confirm('您确定要删除吗？');" type="submit">删除选中</button>
                <button class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</button>
            </div>
        </div>
    </form>
    <div class="pages">
        <?php echo ($page); ?>
    </div>
</div>
</div>
<script>
    $("#selall").click(function(){
        if($(this).attr("checked")){
            $(".selall").attr("checked","checked");
        }else{
            $(".selall").removeAttr("checked");
        }

    })
</script>
</body>
</html>