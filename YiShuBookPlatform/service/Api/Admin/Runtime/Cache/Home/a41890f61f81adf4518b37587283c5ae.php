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
<link rel="stylesheet" href="/thinkphp_3.2.3_full/Public/wangEditor/css/wangEditor.min.css">
<script type="text/javascript" src="/thinkphp_3.2.3_full/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/thinkphp_3.2.3_full/Public/wangEditor/js/wangEditor.min.js"></script>
<style type="text/css">
    .tpt_sels a{padding-right:15px;position:relative}
    .tpt_sels a{padding:0 20px 0 8px;color:#3B6268;background:#FFFFBA;border:1px #F8E06E solid;margin-right:5px;margin-bottom:5px;font-size:14px;height:26px;line-height:26px;display:block;float:left}
    .tpt_pres a.selected{padding:0 8px;color:#3B6268;background:#FFFFBA;border:1px #F8E06E solid;margin-right:5px;margin-bottom:5px;font-size:14px;height:26px;line-height:26px;display:block;float:left}
    .tpt_pres a{padding:0 8px;color:#fff;background:#5AC7A9;border:1px #5AC7A9 solid;margin-right:5px;margin-bottom:5px;font-size:14px;height:26px;line-height:26px;display:block;float:left}
    .tpt_sels a em{width: 12px;height: 12px;font-style: normal;display: block;position: absolute;top: 7px;right: 4px;z-index: 2;background: url(/thinkphp_3.2.3_full/Public/img/sx.png) no-repeat 0 0;}
    .wangEditor-menu-container .menu-item a {padding: 12px 0;}
    .wangEditor-menu-container .menu-item {height: 37px;width: 37px;}
    .wangEditor-menu-container .menu-group {padding: 0;}
    .wangEditor-container {border: 1px solid #e6e6e6;}
</style>
<div class="aright">

    <fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
        <legend>修改文章</legend>
    </fieldset>

    <form class="layui-form bform" method="post" action="<?php echo U('article/doedit');?>" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo ($a["id"]); ?>">
        <div class="layui-form-item">
            <label class="layui-form-label">文章标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required lay-verify="required" value="<?php echo ($a["title"]); ?>" placeholder="必填内容" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" style="width: 300px;">
            <label class="layui-form-label">所属栏目</label>
            <div class="layui-input-block">
                <select name="tid">
                    <?php if(is_array($c)): $i = 0; $__LIST__ = $c;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($a[tid] == $vo[id]): ?>selected="selected"<?php endif; ?> value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">文章作者</label>
            <div class="layui-input-block">
                <input type="text" name="author" value="<?php echo ($a["author"]); ?>" placeholder="请输入内容" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">文章来源</label>
            <div class="layui-input-block">
                <input type="text" name="source" value="<?php echo ($a["source"]); ?>" placeholder="请输入内容" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">审核显示</label>
            <div class="layui-input-block">
                <input type="checkbox" title="显示" name="open" value="1" <?php if($a['open'] == 1): ?>checked<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">推荐精选</label>
            <div class="layui-input-block">
                <input type="checkbox" title="推荐" name="commend" value="1" <?php if($a['commend'] == 1): ?>checked<?php endif; ?>>
                <input type="checkbox" title="精选" name="choice" value="1" <?php if($a['choice'] == 1): ?>checked<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">缩略图</label>
            <div class="layui-input-block">
                <div class="file-box">
                    <i class="layui-icon">&#xe61f;</i>
                    <input class="file-btn" type="button" value="选择图片">
                    <input class="file-txt" type="text" autocomplete="off" name="textfield" id="textfield"><?php if($a[pic] != ''): ?><img src="/thinkphp_3.2.3_full/Uploads<?php echo ($a["pic"]); ?>" height="50"><?php else: endif; ?>
                    <input class="file-file" type="file" name="pic" id="pic" size="28" onchange="document.getElementById('textfield').value=this.value" />
                </div>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文章描述</label>
            <div class="layui-input-block">
                <textarea name="description" placeholder="请输入内容" class="layui-textarea"><?php echo ($a["description"]); ?></textarea>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文章内容</label>
            <div class="layui-input-block">
      <textarea id="textarea" name="content" style="height:600px;width: 100%;">
      <?php echo ($a["content"]); ?></textarea>
            </div>
        </div>

        <div class="tpt_item">
            <input type="hidden" name="keywords" value="<?php echo ($a["keywords"]); ?>">
            <div id="tpt_sel" class="tpt_sels" style="margin-top: 20px;">
		<span style="margin-bottom: 5px;float: left;margin-left: 110px;">
		<?php if($a[keywords] != ''): $arr=explode(',', $a['keywords']);foreach ($arr as $k=>$v){echo "<a href='javascript:;'>$v<em></em></a>";} endif; ?>
		</span>
                <div class="layui-form-item" style="margin-bottom: 10px;">
                    <label class="layui-form-label">文章标签</label>
                    <div class="layui-input-block">
                        <input id="tpt_input" type="text" value="" autocomplete="off" class="layui-input" style="width: 400px;float: left;margin-right: 20px;">
                        <button class="layui-btn" id="tpt_btn" type="button" style="background: #FF5722;">添加标签</button>
                    </div>
                </div>
            </div>
            <div id="tpt_pre" class="tpt_pres layui-input-block cl" style="margin-bottom: 15px;">
                <?php if(is_array($tagss)): $i = 0; $__LIST__ = $tagss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><a href="javascript:;"><?php echo ($tag); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</button>
            </div>
        </div>

    </form>
    <script type="text/javascript">
        $(function() {
            $('#tpt_input').keydown(function(e) {
                if (e.which === 13) {
                    $("#tpt_btn").click();
                    e.preventDefault();
                    return false;
                }
            });
            $("#tpt_sel").on('click', 'a>em', function() {
                var name = "keywords";
                var tag = $(this).parent().text();
                $(this).parent().remove();
                var tags = new Array();
                $("#tpt_sel").find('a').each(function() {
                    tags.push($(this).text());
                });
                $("input[name=" + name + "]").val(tags.join(","));
                $("#tpt_pre a:contains('" + tag + "')").removeClass("selected");
            });
            $("#tpt_btn").click(function() {
                var name = "keywords";
                var tags = $.trim($("input[name=" + name + "]").val());
                if (tags !== "") {
                    tags = tags.split(",");
                } else {
                    tags = new Array();
                }
                var tag = $.trim($("#tpt_input").val());
                if (tag !== '' && $.inArray(tag, tags) === -1) {
                    tags.push(tag);
                    $("#tpt_pre a:contains('" + tag + "')").addClass("selected");
                }
                $("#tpt_sel").children('span').empty();
                $.each(tags, function(k, v) {
                    $("#tpt_sel").children('span').append('<a href="javascript:;">' + v + '<em></em></a>');
                });
                $("input[name=" + name + "]").val(tags.join(","));
                $("#tpt_input").val('');
            });
            $("#tpt_pre").on('click', 'a:not(.selected)', function() {
                var name = "keywords";
                var tags = $.trim($("input[name=" + name + "]").val());
                if (tags !== "") {
                    tags = tags.split(",");
                } else {
                    tags = new Array();
                }
                var tag = $.trim($(this).text());
                if (tag !== '' && $.inArray(tag, tags) === -1) {
                    tags.push(tag);
                }
                $("#tpt_sel").children('span').empty();
                $.each(tags, function(k, v) {
                    $("#tpt_sel").children('span').append('<a href="javascript:;">' + v + '<em></em></a>');
                });
                $("input[name=" + name + "]").val(tags.join(","));
                $(this).addClass('selected');
            });
        });
    </script>
    <script>
        layui.use('form', function(){
            var form = layui.form();
        });
    </script>
    <script type="text/javascript">
        var editor = new wangEditor('textarea');
        editor.config.uploadImgUrl = "<?php echo U('article/doUploadPic');?>";
        editor.create();
    </script>
</div>
</div>
</body>
</html>