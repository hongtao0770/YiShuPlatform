<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Response;
header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function count()
    {
        $userid = I('post.userid');
        $order = M('order');
        $friend = M('friend');
        $notice = M('notice');

        $result1 = $order->where("userid = '$userid'")->count();
        $result2 = $friend->where("userid = '$userid'")->count();
        $result3 = $notice->where("userid = '$userid'")->count();
        $data = array(
            'ordercount'=>$result1,
            'friendcount'=>$result2,
            'noticecount'=>$result3
        );
//        echo  json_encode($data);
        var_dump(Response::json('1001','success',$data));
        Response::json('1001','success',$data);
    }
}