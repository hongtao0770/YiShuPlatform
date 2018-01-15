<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/26
 * Time: 15:55
 */
namespace Home\Controller;
use Home\Common\Response;
use Home\Controller;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class RegisterController extends \Think\Controller
{
    function register($phone,$nickname,$password)
    {
        $user = M('user');
        $data = $user->where("phone = '%s'",$phone)->select();
        if ($data)
        {
            Response::json('-1001','用户已存在');
        }else
        {
            //生成默认头像
            $picture = "/2018-01-02/morentouxiang.png";
            //密码md5加密
            $pwd = md5($password);
            //生成昵称
            $money = 100;
//            $nickname = 'U' . $nickname . 'er';
            $data1 =array(
                'phone'=>$phone,
                'password'=>$pwd,
                'nickname'=>$nickname,
                'state'=>1,
                'picture'=>$picture,
                'money'=>$money
            );
            $output =$user->add($data1);
            Response::json('1001','注册成功', $output);
        }
    }
}