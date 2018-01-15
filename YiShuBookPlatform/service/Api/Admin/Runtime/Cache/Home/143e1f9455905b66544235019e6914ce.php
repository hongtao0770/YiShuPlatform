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
        <legend>系统设置</legend>
    </fieldset>
    <div class="layui-tab" lay-filter="demo" style="margin: 20px 30px 20px 20px;">
        <ul class="layui-tab-title">
            <li class="layui-this">登录日志</li>
            <li>销售记录</li>
            <li>系统状态</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form  onsubmit="return false" id="form1" class="aform cl" >
                    <table width="100%" style="margin-left: -20px">
                        <tr>
                            <th width="5%" align="center"><input type="checkbox" name="checkbox" id="selall"/></th>
                            <th width="10%" align="center">管理员名</th>
                            <th width="20%" align="center">登录IP</th>
                            <th width="15%" align="center">所在位置</th>
                            <th width="20%" align="center">登录时间</th>
                            <th width="10%" align="center">登录次数</th>
                            <th width="20%" align="center">基本操作</th>
                        </tr>
                        <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input type="checkbox" class="selall deletes" name="deletes[]" value="<?php echo ($vo["adminid"]); ?>"></td>
                                <td align="center"><?php echo ($vo["adminname"]); ?></td>
                                <td align="center"><?php echo ($vo["ip"]); ?></td>
                                <td align="center"><?php echo ($vo["country"]); ?></td>
                                <td align="center"><?php echo ($vo["time"]); ?></td>
                                <td align="center"><?php echo ($vo["count"]); ?></td>
                                <td align="center">
                                    <a href="#" onclick="del(<?php echo ($vo["adminid"]); ?>)">删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                    <div class="layui-form-item">
                        <div style="margin-top: 20px;">
                            <button style="background-color:#393D49 "  class="layui-btn" onclick="dels('this','<?php echo U('System/deletes');?>')"><i class="layui-icon"></i>删除选中</button>
                        </div>
                    </div>
                </form>

                <div class="pages">
                    <?php echo ($page); ?>
                </div>
            </div>


            <div class="layui-tab-item">
                <div class="content has-header" style="width: 100%;height: 400px;" >
                    <div id="main" style="width: 600px;height:400px;float: left"></div>
                    <div style="width: 42%;height: 400px;float: right;">
                        <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><div style="width: 48%;height: 30%;margin-top:30px;float:left;border:2px solid gainsboro">
                            <div style="width: 30%;height: 100%;float: left;border-left: 4px solid black;">
                                <img src="/YiShuBookPlatform/service/Api/Public/img/adminTx.png" style="margin-top: 25px">
                            </div>

                            <div style="width: 68%;height: 100%;float: right">
                                <p></p>
                                <p style="font-size: 1.7em;margin-left: 20px;margin-top: 34px"><?php echo ($vo1["adminname"]); ?></p>
                                <p style="font-size: 1em;margin-left: 20px;color: gray">登录<?php echo ($vo1["count"]); ?>次</p>
                            </div>
                        </div>
                        <div style="width: 48%;height: 30%;margin-top:30px;float:right;border:2px solid gainsboro">
                            <div style="width: 30%;height: 100%;float: left;border-left: 4px solid #E36159">
                                <img src="/YiShuBookPlatform/service/Api/Public/img/yue.png" style="width:64px;margin-top: 25px">
                            </div>
                            <div style="width: 68%;height: 100%;float: right">
                                <p style="font-size: 1.7em;margin-left: 10px;margin-top: 34px;">￥<?php echo ($vo1["money"]); ?></p>
                                <p style="font-size: 1em;margin-left: 98px;color: steelblue">提现</p>
                                <img src="/YiShuBookPlatform/service/Api/Public/img/支付宝(1).png" width="70px" style="margin-left: 80px;margin-top: 10px">
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        <div style="width: 48%;height: 30%;margin-top:20px;float:right;border:2px solid gainsboro">
                            <div style="width: 30%;height: 100%;float: left;border-left: 4px solid #724AA9">
                                <img src="/YiShuBookPlatform/service/Api/Public/img/usertx.png" style="width:64px;margin-top: 25px">
                            </div>
                            <div style="width: 68%;height: 100%;float: right">
                                <p style="font-size: 1em;margin-left: 20px;margin-top: 30px;color: gray">用户数</p>
                                <p style="font-size: 1.7em;margin-left: 20px;"><?php echo ($list5); ?>位</p>
                            </div>
                        </div>

                        <div style="width: 48%;height: 30%;margin-top:20px;float:left;border:2px solid gainsboro">
                            <div style="width: 30%;height: 100%;float: left;border-left: 4px solid #2AABB1">
                                <img src="/YiShuBookPlatform/service/Api/Public/img/dingdan.png" style="width:64px;margin-top: 25px">
                            </div>
                            <div style="width: 68%;height: 100%;float: right">
                                <p style="font-size: 1em;margin-left: 20px;margin-top: 30px;color: gray">订单数</p>
                                <p style="font-size: 1.7em;margin-left: 20px;"><?php echo ($list4); ?>笔</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-tab-item">
                    <div class="layui-form-item">
                        <label class="layui-form-label">系统状态</label>
                        <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><div class="layui-input-block">
                            <?php if($vo1[systemstate] == 1): ?><a href="#" onclick="action(this,<?php echo ($vo1["systemid"]); ?>)" class="layui-btn">启用中</a><?php endif; ?>
                            <?php if($vo1[systemstate] == 0): ?><a href="#"onclick="action(this,<?php echo ($vo1["systemid"]); ?>)"  class="layui-btn layui-btn-danger">关闭中</a><?php endif; ?>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
            </div>


        </div>

    </div>

</div>
</div>
<script>


    layui.use('form', function(){
        var form = layui.form();
    });



    layui.use('element', function(){
        var element = layui.element;
    });

    function action(obj,systemid) {
        layui.use('layer', function () {
            var loading = layer.load(2, {
                shade: [0.2, '#000']
            });
            $.ajax({
                type: 'post',
                url: '<?php echo U("System/appSvc");?>',
                data: {
                    systemid: systemid
                },
                success: function (data) {
                    if (data.response == 0) {
                        $(obj).removeClass(' layui-btn-danger').addClass('layui-btn-danger').text('关闭中');
                        layer.msg(data.msg, {icon: 5, time: 1000}, function () {
                            layer.close(loading);
                        });
                    } else if (data.response == 1) {
                        $(obj).removeClass(' layui-btn-danger').addClass('').text('启用中');
                        layer.msg(data.msg, {icon: 6, time: 1000}, function () {
                            layer.close(loading);
                        });
                    }
                }
            });
        });
    }

    $("#selall").click(function(){
        if($(this).attr("checked")){
            $(".selall").attr("checked","checked");
        }else{
            $(".selall").removeAttr("checked");
        }

    })
    //删除
    function del(adminid) {
        layui.use('layer', function () {
            layer.confirm('确定删除本条数据？', {title: '提示'}, function (index) {
                var loading = layer.load(2, {
                    shade: [0.2,'#000']
                });
                $.ajax({
                    url: "<?php echo U('System/delete');?>",
                    type: 'post',
                    data: {
                        adminid: adminid
                    },
                    success: function (data, status) {
                        if (data.code == 200) {
                            layer.close(index);
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                                location.href = "<?php echo U('System/index');?>"
                            });
                        } else {
                            layer.close(index);
                            layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
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
                                location.href = "<?php echo U('System/index');?>"
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


//    $.ajax({
//        type: 'post',
//        url: '<?php echo U("System/getAllBook");?>',
//
//        success: function (data) {
//            console.log(data);
//        }
//    });

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    option = {
        title : {
            text: '易书图书销量统计',
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['新图书销量','二手书销量']
        },
        toolbox: {
            show : true,
            feature : {
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'新图书销量',
                type:'bar',
                data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            },
            {
                name:'二手书销量',
                type:'bar',
                data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
                markPoint : {
                    data : [
                        {name : '年最高', value : 182.2, xAxis: 7, yAxis: 183},
                        {name : '年最低', value : 2.3, xAxis: 11, yAxis: 3}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name : '平均值'}
                    ]
                }
            }
        ]
    };


    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

</script>
</body>
</html>