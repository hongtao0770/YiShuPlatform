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
    <script src="/YiShuBookPlatform/service/Api/Public/js/jquery-2.2.3.min.js"></script>
    <script src="/YiShuBookPlatform/service/Api/Public/js/echarts.common.min.js"></script>
    <style>
        .header
        {
            background-color:#393D49 ;
        }
    </style>
    <script>
        function fun1()
        {
            layui.use('layer', function () {
                //定义全局layer变量
                layer = layui.layer;

                layer.prompt({title: '输入管理员口令，并确认', formType: 1}, function(pass, index) {

                    $.ajax({
                        url:"<?php echo U('Login/Koulin');?>",
                        type:'post',
                        data:{
                            pass:pass
                        },
                        success:function (data, status) {
                            if(data.code == 200) {
                                layer.close(index);
                                layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                                    location.href = '<?php echo U("System/index");?>';;
                                });
                            }else{
                                layer.close(index);
                                layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                            }
                        },
                    })
                });
            });
        }

        function logout() {
            layui.use('layer', function () {
                var loading = layer.load(1, {
                    shade: [0.2, '#000']
                });

                    $.ajax({
                        url: "<?php echo U('Login/logout');?>",
                        type: 'post',
                        data: {
                        },
                        success: function (data, status) {
                            if (data.code == 200) {
                                layer.close(loading);
                                layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                                    location.href = "<?php echo U('Login/index');?>"
                                });
                            } else {
                                layer.close(loading);
                                layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                            }
                        },
                    });
                });
        }
    </script>
</head>
<body>
<div class="header" >
    <h2 class="z cl"><a href="<?php echo U('index/index');?>"><img src="/YiShuBookPlatform/service/Api/Public/img/icon.png " style="height: 50px">易书图书后台管理系统</a></h2>
    <h2 class="y cl"><a href="<?php echo U('Message/index');?>"><img src="/YiShuBookPlatform/service/Api/Public/img/邮件(2).png " style="height: 50px"></a></h2>
</div>
<div class="admin">
    <div class="aleft">
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #393D49;">&#xe643;</i>操作菜单</h3>
        <ul class="cl">
            <li><i class="icon ion-android-list"></i><a href="<?php echo U('book/index');?>"> 新书管理</a></li>
            <li><i class="icon ion-android-clipboard"></i><a href="<?php echo U('oldbook/index');?>"> 二手书管理</a></li>
            <li><i class="icon ion-person-add"></i><a href="<?php echo U('user/index');?>"> 用户管理</a></li>
            <li><i class="icon ion-aperture"></i><a href="<?php echo U('friend/index');?>"> 动态管理</a></li>
            <li><i class="icon ion-compose"></i></i><a href="<?php echo U('Order/index');?>"> 订单管理</a></li>
            <li><i class="icon ion-leaf"></i><a href="<?php echo U('Activity/index');?>"> 活动管理</a></li>
            <li><i class="icon ion-android-checkbox-outline"></i><a href="<?php echo U('Examine/index');?>"> 审核管理</a></li>

        </ul>
        <h3><i class="layui-icon" style="position: relative;right: 3px;top: 1px;font-size: 18px;color: #393D49;">&#xe614;</i>系统管理</h3>
        <ul class="cl">
            <li><i class="icon ion-ios-cog"></i><a href="#" onclick="fun1()"> 系统设置</a></li>
            <li><i class="icon ion-settings"></i><a href="<?php echo U('Password/index');?>"> 密码修改</a></li>
            <li><i class="icon ion-reply-all"></i><a href="#" onclick="logout()" > 立即退出</a></li>
        </ul>

    </div>
<div class="aright">

    <fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
        <legend>修改用户</legend>
    </fieldset>

    <form class="layui-form bform" onsubmit="return false" id="form1" enctype="multipart/form-data">
        <input type="hidden" name="userid" value="<?php echo ($l["userid"]); ?>">


        <div class="layui-form-item">
            <label class="layui-form-label">用户昵称</label>
            <div class="layui-input-block">
                <input  name="nickname" value="<?php echo ($l["nickname"]); ?>" placeholder="请输入内容"  autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input  name="phone" value="<?php echo ($l["phone"]); ?>" placeholder="请输入内容"  autocomplete="off" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">地址</label>
            <div class="layui-input-block">
                <input  name="address" value="<?php echo ($l["address"]); ?>" placeholder="暂无地址"  autocomplete="off" class="layui-input" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">用户头像</label>
            <div class="layui-input-block">
                <div class="file-box">
                    <i class="layui-icon">&#xe61f;</i>
                    <input class="file-btn" type="button" value="选择图片">
                    <input class="file-txt" type="text" autocomplete="off" name="textfield" id="textfield"><?php if($l[picture] != ''): ?><img src="/YiShuBookPlatform/service/Api/Uploads<?php echo ($l["picture"]); ?>" height="50"><?php else: endif; ?>
                    <input class="file-file" type="file" name="picture" id="picture" size="28" onchange="document.getElementById('textfield').value=this.value" />
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" onclick="edit()" lay-filter="formDemo"  style="background-color:#393D49 ">立即提交</button>
                <button class="layui-btn layui-btn-primary" onclick="history.go(-1)">返回</button>
            </div>
        </div>

    </form>
    <script>
        layui.use('form', function(){
            var form = layui.form();
        });

        function edit() {

            layui.use('layer', function () {
                var loading = layer.load(2, {
                    shade: [0.2,'#000']
                });


                var data = new FormData($('#form1')[0]);
                $.ajax({
                    url: "<?php echo U('User/doedit');?>",
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data, status) {
                        if (data.code == 200) {
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                                location.href = "<?php echo U('User/index');?>";
                            });
                            return false;
                        } else {
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                        }
                    },

                    fail: function (err, status) {
                        console.log(err)
                    }
                });
            });
        }
    </script>
</div>
</div>
</body>
</html>