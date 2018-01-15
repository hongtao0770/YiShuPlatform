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
    <fieldset class="layui-elem-field layui-field-title" style="margin: 20px 30px 20px 20px;">
        <legend>新书管理</legend>
    </fieldset>

    <div class="layui-tab" style="margin: 20px 30px 20px 20px;">
        <ul class="layui-tab-title">
            <li class="layui-this">新书管理</li>
            <li>排行榜管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="arz cl" style="margin-left: 10px"><a href="<?php echo U('book/add');?>"><i class="layui-icon">&#xe608;</i>添加图书</a></div>

                <form method="post" class="aform cl">
                    <table width="100%"  style="margin-left: -20px">
                        <tr>
                            <th width="10%" align="center">图书编号</th>
                            <th width="20%" align="center">图书名称</th>
                            <th width="10%" align="center">图书价格</th>
                            <th width="15%" align="center">图书封面</th>
                            <th width="10%" align="center">是否打折</th>
                            <th width="10%" align="center">首页推荐</th>
                            <th width="10%" align="center">销售量</th>
                            <th width="15%" align="center">基本操作</th>
                        </tr>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><?php echo ($vo["bookid"]); ?></td>
                                <td align="center">《<?php echo ($vo["bookname"]); ?>》</td>
                                <td align="center">￥<?php echo ($vo["bookprice"]); ?></td>
                                <td align="center">
                                    <?php if($vo[bookposter] != ''): ?><img src="/YiShuBookPlatform/service/Api/Uploads<?php echo ($vo["bookposter"]); ?>" height="30" onclick="img(<?php echo ($vo["bookid"]); ?>)">
                                        <?php else: ?>
                                        暂无封面<?php endif; ?>
                                </td>
                                <td align="center">
                                    <?php if($vo['booksale'] == 1): ?><img src="/YiShuBookPlatform/service/Api/Public/img/sale.png" style="width: 25px">打折<?php endif; ?>
                                    <?php if($vo['booksale'] == 0): ?>不打折<?php endif; ?>
                                </td>
                                <td align="center">
                                    <?php if($vo['bookshow'] == 1): ?><img src="/YiShuBookPlatform/service/Api/Public/img/tuijian.png" style="width: 20px">首页推荐<?php endif; ?>
                                    <?php if($vo['bookshow'] == 0): ?>不推荐<?php endif; ?>
                                </td>
                                <td align="center">
                                    <?php if($vo['salesnum'] == null): ?>0本
                                        <?php else: ?>
                                        <?php echo ($vo["salesnum"]); ?>本<?php endif; ?>
                                </td>
                                <td align="center">
                                    <a href="<?php echo U('book/edit',array('bookid'=>$vo['bookid']));?>">修改</a> |
                                    <a href="#" onclick="del(<?php echo ($vo["bookid"]); ?>)">删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </form>
                <div class="pages">
                    <?php echo ($page); ?>
                </div>
            </div>
            <div class="layui-tab-item">
                <div class="arz cl" style="margin-left: 10px"><a href="#" onclick="update()"><i class="layui-icon">&#x1002;</i>更新排行榜</a></div>
                <form method="post" class="aform cl">
                    <table width="100%" style="margin-left: -20px">
                        <tr>
                            <th width="5%" align="center">图书排行</th>
                            <th width="10%" align="center">图书封面</th>
                            <th width="10%" align="center">图书名称</th>
                        </tr>
                        <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center">
                                    <?php if($vo2['rank'] == 1): ?><span class="layui-badge">1</span><?php endif; ?>
                                    <?php if($vo2['rank'] == 2): ?><span class="layui-badge layui-bg-orange">2</span><?php endif; ?>
                                    <?php if($vo2['rank'] == 3): ?><span class="layui-badge layui-bg-orange">3</span><?php endif; ?>
                                    <?php if($vo2['rank'] == 4): ?><span class="layui-badge layui-bg-green">4</span><?php endif; ?>
                                    <?php if($vo2['rank'] == 5): ?><span class="layui-badge layui-bg-green">5</span><?php endif; ?>
                                </td>
                                <td align="center"><img src="/YiShuBookPlatform/service/Api/Uploads/<?php echo ($vo2["bookposter"]); ?>"height="30"></td>
                                <td align="center">《<?php echo ($vo2["bookname"]); ?>》</td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </form>
            </div>
        </div>
    </div>


</div>
</div>
<script>
    layui.use('element', function(){
        var element = layui.element;
    });
    function img(id) {
//        console.log(id);
        layui.use('layer', function () {
            //定义全局layer变量

            $.ajax({
                url:"<?php echo U('Book/img');?>",
                type:'post',
                data:{
                    bookId:id
                },
                success:function (data, status) {
                    var image = "/YiShuBookPlatform/service/Api/Uploads"+data.mgs;
                    console.log(image);
                    layer.open({
                        type: 1,
                        title: false,
                        closeBtn: 0,
                        area: '300px',
                        skin: 'layui-layer-nobg', //没有背景色
                        shadeClose: true,
                        content: "<img id='bookimg' src='' style='height: 50%;width: 100%'>"
                    });
                    $('#bookimg').attr('src',image);
                    $('.layui-layer-nobg').css({"margin-top":"-150px"});

                },
            })

        });
    }
    function del(bookid) {
        layui.use('layer', function () {
            layer.confirm('确定删除本条数据？', {title: '提示'}, function (index) {
                var loading = layer.load(2, {
                    shade: [0.2,'#000']
                });
                $.ajax({
                    url: "<?php echo U('Book/delete');?>",
                    type: 'post',
                    data: {
                        bookid: bookid
                    },
                    success: function (data, status) {
                        if (data.code == 200) {
                            layer.close(index);
                            layer.close(loading);
                            layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                                location.href = "<?php echo U('Book/index');?>"
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

    function update() {
        layui.use('layer', function () {
            var loading = layer.load(2, {
                shade: [0.2,'#000']
            });


            $.ajax({
                url: "<?php echo U('Book/rank');?>",
                type: 'POST',
                dataType: 'json',
                success: function (data, status) {
                    if (data.code == 200) {
                        layer.close(loading);
                        layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                            location.href = "<?php echo U('Book/index');?>";
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
</body>
</html>