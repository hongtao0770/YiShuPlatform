<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>

    <link rel="stylesheet" href="/YiShuBookPlatform/service/Api/Public/layui/css/layui.css">
    <script src="/YiShuBookPlatform/service/Api/Public/js/jquery-2.2.3.min.js"></script>
    <style>

        body {
            overflow: hidden;
        }
        .layer_notice {
            background: #5fb878 none repeat scroll 0 0;
            float: left;
            height: 75px;
            overflow: hidden;
            padding: 10px;
            width: 330px;
        }
        .layer_notice ul li {
            color: #fff;
        }
        .video-player {
            background-color: transparent;
            min-width: 100%;
            min-height: 100%;
            display: block;
            position: absolute;
            z-index: 1;
            top: 0;
        }

        .video_mask {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 90;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .login {
            /*height: 260px;*/
            width: 260px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin: -150px 0 0 -150px;
            z-index: 99;
        }

        .login h1 {
            text-align: center;
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form_code {
            position: relative;
        }

        .form_code .code {
            position: absolute;
            right: 0;
            top: 1px;
            cursor: pointer;
        }
        .login_btn {
            width: 100%;
        }
    </style>

</head>
<body>
<div class="layui-carousel video_mask" id="login_carousel" >
    <img src="/YiShuBookPlatform/service/Api/Public/img/002.jpg" style="height: 100%;width: 100%">

    <div class="login layui-anim layui-anim-up">
        <h1>后台登录</h1></p>
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <input type="text" name="adminname" lay-verify="required" placeholder="请输入账号" autocomplete="off"  value="" class="layui-input">
            </div>
            <div class="layui-form-item">
                <input type="password" name="adminpassword" lay-verify="required" placeholder="请输入密码" autocomplete="off" value="" class="layui-input">
            </div>
            <div class="layui-form-item">
                <button class="layui-btn login_btn" lay-submit lay-filter="login">登陆系统</button>
            </div>
        </form>

    </div>

</div>

<script src="/YiShuBookPlatform/service/Api/Public/layui/layui.js"></script>
<script>

    layui.use('form', function(){
        var form = layui.form()
            ,jq = layui.jquery;

        form.on('submit(login)', function(data){
            loading = layer.load(2, {
                shade: [0.2,'#000']
            });
            var param = data.field;
            jq.post('<?php echo U("Login/logincheck");?>',param,function(data){
                if(data.code == 200){
                    layer.close(loading);
                    layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                        location.href = '<?php echo U("Index/index");?>';

//                        $.pjax({url: '<?php echo U("Index/index");?>', container: '.aright'});
                    });
                }else{
                    layer.close(loading);
                    layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                }
            });
            return false;
        });

    })
</script>
</body>

</html>