<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>
</head>
<body>
<div>
    <form id="login" method="post" action="loginCheck">

        <div>
            <label >用户名</label>
            <input type="text"  name="username">
        </div>
        <div>
            <label >密码</label>
            <input type="password"  name="password">
        </div>
        <div>
            <input type="submit" value="登录">
        </div>
    </form>

</div>
</body>
</html>