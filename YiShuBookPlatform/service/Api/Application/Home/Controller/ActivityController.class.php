<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/26
 * Time: 19:26
 */
namespace Home\Controller;
use Home\Common\Response;
use Home\Controller;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class ActivityController extends \Think\Controller
{
     public function getActivities()
     {
         $activity = M('activity');
         $data = $activity->select();
         if ($data)
         {
             Response::json('1001','获取活动信息成功',$data);
         }else
         {
             Response::json('-1001','获取活动信息失败');
         }
     }
}