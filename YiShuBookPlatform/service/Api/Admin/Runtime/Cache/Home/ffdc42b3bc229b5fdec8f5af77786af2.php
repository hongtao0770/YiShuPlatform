<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/YiShuBookPlatform/service/Api/Public/layui/css/layui.css">
</head>
<body>
<p>hello</p>

<script src="/YiShuBookPlatform/service/Api/Public/layui/layui.js"></script>
<script>
    layui.use('layer', function(){
        var layer = layui.layer;

        layer.msg('同上', {
            icon: 1,
            time: 2000 //2秒关闭（如果不配置，默认是3秒）
        }, function(){
            //do something
            alert('ddd');
        });
    });
</script>
<script>
    layui.use('layer', function(){
        var layer = layui.layer;

        layer.msg('同上', {
            icon: 1,
            time: 2000 //2秒关闭（如果不配置，默认是3秒）
        }, function(){
            //do something
            alert('ggg');
        });
    });
</script>
</body>
</html>