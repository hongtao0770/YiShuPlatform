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

    <fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
        <legend>修改栏目</legend>
    </fieldset>

    <form class="layui-form bform" method="post" action="<?php echo U('category/doedit');?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo ($c["id"]); ?>">
        <div class="layui-form-item">
            <label class="layui-form-label">栏目名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="<?php echo ($c["name"]); ?>" required lay-verify="required" placeholder="必填内容" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" style="width: 300px;">
            <label class="layui-form-label">所属栏目</label>
            <div class="layui-input-block">
                <select name="tid">
                    <option value="0">顶级栏目</option>
                    <?php if(is_array($cs)): $i = 0; $__LIST__ = $cs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($c[id] == $vo[id]): ?>disabled<?php endif; ?>
                        <?php if($c[tid] == $vo[id]): ?>selected="selected"<?php endif; ?>value="<?php echo ($vo["id"]); ?>"><?php echo str_repeat('-',$vo[level]*8); echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">所属类型</label>
            <div class="layui-input-block">
                <input type="radio" name="type" value="1" title="文章" <?php if($c['type'] == 1): ?>checked=""<?php endif; ?>>
                <input type="radio" name="type" value="2" title="产品" <?php if($c['type'] == 2): ?>checked=""<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">缩略图</label>
            <div class="layui-input-block">
                <div class="file-box">
                    <i class="layui-icon">&#xe61f;</i>
                    <input class="file-btn" type="button" value="选择图片">
                    <input class="file-txt" type="text" autocomplete="off" name="textfield" id="textfield"><?php if($c[pic] != ''): ?><img src="/thinkphp_3.2.3_full/Uploads<?php echo ($c["pic"]); ?>" height="50"><?php else: endif; ?>
                    <input class="file-file" type="file" name="pic" id="pic" size="28" onchange="document.getElementById('textfield').value=this.value" />
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">关键词</label>
            <div class="layui-input-block">
                <input type="text" name="keywords" value="<?php echo ($c["keywords"]); ?>" placeholder="请输入内容" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea name="description" placeholder="请输入内容" class="layui-textarea"><?php echo ($c["description"]); ?></textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</button>
            </div>
        </div>

    </form>
    <script>
        layui.use('form', function(){
            var form = layui.form();
        });
    </script>
</div>
</div>
</body>
</html>