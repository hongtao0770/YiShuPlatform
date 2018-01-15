<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/26
 * Time: 11:20
 */
namespace Home\Controller;
use Home\Common\Response;
use Home\Controller;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class LoginController extends \Think\Controller
{
    function checkLogin($phone,$pwd)
    {

        $user = M('user');
        $data = $user->where("phone = '%s'",$phone)->find();

        if(!$data){
            Response::json('-1001','用户不存在');
        }else{
           if($data['password'] == md5($pwd) && $data['state'] == 1)
           {
               Response::json('1001','登录成功',$data);
           }elseif($data['password'] == md5($pwd) && $data['state'] == 0)
           {
               Response::json('-1002','用户已被禁用',$data);
           }
           elseif($data['password'] == md5($pwd) && $data['state'] == 2)
           {
               Response::json('-1003','系统维护中',$data);
           }
           elseif($data['password'] != md5($pwd) && $data['state'] == 1)
           {
               Response::json('-1004','登录失败');
           }
        }
    }
}