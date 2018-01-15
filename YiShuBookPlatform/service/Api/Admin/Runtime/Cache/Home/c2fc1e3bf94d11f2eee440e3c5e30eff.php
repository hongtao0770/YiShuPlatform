<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/YiShuBookPlatform/service/Api/Public/img/icon.png" type="image/x-icon" />
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
<script src="/YiShuBookPlatform/service/Api/Public/js/jquery-1.4.2.min.js"></script>
<div class="aright">
    <fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
        <legend>管理员邮件</legend>
    </fieldset>

    <div class="arz cl"><a href="<?php echo U('message/add');?>"><i class="layui-icon">&#xe642;</i>发邮件</a></div>

    <form method="post" onsubmit="return false" class="aform cl" id="form1">
        <table width="100%">
            <tr>
                <th width="5%" align="center"><input type="checkbox" name="checkbox" id="selall"/></th>
                <th width="20%" align="center">邮件</th>
                <th width="20%" align="center">发件人</th>
                <th width="20%" align="center">联系电话</th>
                <th width="20%" align="center">发件时间</th>
                <th width="20%" align="center">基本操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><input type="checkbox" class="selall deletes" name="deletes[]" value="<?php echo ($vo["messageid"]); ?>"></td>
                    <td align="center"><?php if($vo[state] == 0): ?><img id="img1" src="/YiShuBookPlatform/service/Api/Public/img/youjian.png"><?php endif; ?>
                        <?php if($vo[state] == 1): ?><img id="img2" src="/YiShuBookPlatform/service/Api/Public/img/邮件(5).png" style="height: 19px;width: 19px"><?php endif; ?>
                    </td>
                    <td align="center"><?php echo ($vo["nickname"]); ?></td>
                    <td align="center">
                        <?php if($vo[phone] == ''): ?>未填写
                        <?php else: ?>
                        <?php echo ($vo["phone"]); endif; ?></td>
                    <td align="center"><?php echo ($vo["messagetime"]); ?></td>
                    <td align="center">
                        <a href="#" onclick="message(<?php echo ($vo["messageid"]); ?>)">查看</a>
                        <a href="#" onclick="del(<?php echo ($vo["messageid"]); ?>)">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="layui-form-item">
            <div style="margin-top: 20px;">
                <button style="background-color:#393D49 "  class="layui-btn" onclick="dels('this','<?php echo U('Message/deletes');?>')"><i class="layui-icon"></i>删除选中</button>
            </div>
        </div>
    </form>
    <div class="pages">
        <?php echo ($page); ?>
    </div>
</div>
</div>
<script>
    function message(x) {
        layui.use('layer', function () {
            //定义全局layer变量

            $.ajax({
                url:"<?php echo U('message/look');?>",
                type:'post',
                data:{
                    id:x
                },
                success:function (data, status) {
                    x = data.mgs;
                    y = data.time;
                    n = data.name;
                    $("#img1").attr("src","/YiShuBookPlatform/service/Api/Public/img/邮件(5).png").css({"height":"19px","width":"19px"});
                    layer.open({
                        type: 1,
                        area: ['420px', '240px'], //宽高
                        content: "<p style='margin-left: 10px;color: cornflowerblue'>"+"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+x+"</p>"+"<br><p style='text-align: right;margin-right: 10px;margin-top: 70px'>时间："+y+"</p>"+"<br><p style='text-align: right;margin-right: 10px'>用户名："+n
                    });
                },
            })

        });
    }

    $("#selall").click(function(){
        if($(this).attr("checked")){
            $(".selall").attr("checked","checked");
        }else{
            $(".selall").removeAttr("checked");
        }

    })

    function del(messageid) {
        layui.use('layer', function () {
            layer.confirm('确定删除本条数据？', {title: '提示'}, function (index) {
                var loading = layer.load(2, {
                    shade: [0.2,'#000']
                });
                $.ajax({
                    url: "<?php echo U('Message/delete');?>",
                    type: 'post',
                    data: {
                        messageid: messageid
                    },
                    success: function (data, status) {
                        if (data.code == 200) {
                            layer.close(index);
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                                location.href = "<?php echo U('Message/index');?>"
                            });
                            return false
                        } else {
                            layer.close(index);
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                            return false
                        }
                    },
                });
            });
        });
    }

    function dels(obj, url) {
        layui.use('layer', function () {
            var layer = layui.layer;
            var loading = layer.load(2, {
                    shade: [0.2,'#000']
                });
            layer.confirm('确定批量删除数据？', {title: '提示'}, function (index) {
                var data = $('.deletes').serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        if (data.code == 200) {
                            layer.close(index);
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                                location.href = "<?php echo U('Message/index');?>"
                            });
                        } else {
                            layer.close(index);
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                        }
                    }
                });
                layer.close(index);
            });
        });
    }
</script>

</body>
</html>