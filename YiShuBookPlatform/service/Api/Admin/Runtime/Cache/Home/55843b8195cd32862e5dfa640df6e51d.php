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
<div class="aright">
    <div class="aright_1">
        <blockquote style="padding: 10px;border-left: 5px solid #FF5722;" class="layui-elem-quote">登录信息：</blockquote>
        <table class="layui-table">
            <thead>
            <th style="text-align: center;color:black;">管理员名</th><th style="text-align: center;color:black;">登录Ip</th><th style="text-align: center;color:black;">所在位置</th><th style="text-align: center;color:black;">最后一次登陆时间</th><th style="text-align: center;color:black;">登录次数</th>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;color:black;"><?php echo ($data["adminname"]); ?></td>
                    <td style="text-align: center;color:black;"><?php echo ($data["ip"]); ?></td>
                    <td style="text-align: center;color:black;"><?php echo ($data["country"]); ?></td>
                    <td style="text-align: center;color:black;"><?php echo ($data["time"]); ?></td>
                    <td style="text-align: center;color:black;"><?php echo ($data["count"]); ?>次</td>
                </tr>
            </tbody>
        </table>
        <br>
        <blockquote style="padding: 10px;border-left: 5px solid #FF5722;" class="layui-elem-quote">欢迎使用易书图书后台管理系统，先温馨提醒几个常见问题：</blockquote>
        <table width="100%">
            <tr>
                <td width="480px">程序正式上线运营请把admin.php里面调试模式关闭；</td>
                <td>确认服务器或空间开启了伪静态；</td>
            </tr>
            <tr>
                <td>安装完成后请将根目录install文件和index.php里面安装代码删除；</td>
                <td>请将程序内的所有文件直接放在根目录下，不要多层目录；</td>
            </tr>
            <tr>
                <td>尽管本程序在发布前已经经过了若干严格测试，但我们依然强烈建议您随时备份；</td>
                <td>程序安装好后一定记得修改密码和口令；</td>
            </tr>
        </table>
        <blockquote style="padding: 10px;border-left: 5px solid #FF5722;" class="layui-elem-quote">服务器信息：</blockquote>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <td style=";color:black;">操作系统</td>
                    <td style=";color:black;">Windows</td>
                </tr>
                <tr>
                    <td style=";color:black;">运行环境</td>
                    <td style=";color:black;">Apache</td>
                </tr>
                <tr>
                    <td style=";color:black;">PHP运行方式</td>
                    <td style=";color:black;">apache2handler</td>
                </tr>
                <tr>
                    <td style=";color:black;">ThinkPHP版本</td>
                    <td style=";color:black;">3.2.3 [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]</td>
                </tr>
                <tr>
                    <td style=";color:black;">上传附件限制</td>
                    <td style=";color:black;">50M</td>
                </tr>
                <tr>
                    <td style=";color:black;">执行时间限制</td>
                    <td style=";color:black;">300秒</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
<script>
//    layui.use('layer', function () {
//        layer.open({
//            type: 1,
//            title: false,//不显示标题栏,
//            closeBtn: false,
//            shade: 0.8,
//            id: 'LAY_layuipro' ,//设定一个id，防止重复弹出
//            btn: ['确定'],
//            btnAlign: 'c',
//            moveType: 1 ,//拖拽模式，0或者1,
//            content: '<div style="padding: 30px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">' +
//            '用户名：sys1<br>' +
//            '密&nbsp;&nbsp;&nbsp;码：sys1<br>' +
//            '开源地址：<br>' +
//            '<a href="https://github.com/shuaijunlan/Autumn-Framework" target="_blank" style="color: greenyellow">https://github.com/shuaijunlan/Autumn-Framework(点击跳转)</a></div>'
//            ,
//            success: function (layero) {
//
//            }
//        });
//    });
</script>
</html>