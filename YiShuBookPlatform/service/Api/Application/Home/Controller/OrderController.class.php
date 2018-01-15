<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/27
 * Time: 16:02
 */
namespace Home\Controller;
use Home\Common\Response;
use Home\Controller;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class OrderController extends \Think\Controller
{
    public function addOrder()
    {
        $bookid = I('post.bookId');
        $bookname = I('post.bookName');
        $orderPrice = I('post.orderPrice');
        $userid = I('post.userId');
        $orderAdress = I('post.orderAdress');
        $orderPic = I('post.orderPic');
        $time = date("Y-m-d H:i",time());

        $order = M('order');

        //销量加1
        $book = M('book');
        $result6 = $book->where("bookId = '$bookid'")->find();
        $arr2 =array(
            'salesnum'=>$result6['salesnum']+1
        );
        $result7 =$book->where("bookId = '$bookid'")->save($arr2);
        //用户扣钱
        $user = M('user');
        $result1 = $user->where("userid = '$userid'")->find();
        $arr = array(
            'money'=>$result1['money']-$orderPrice
        );
        $result2 = $user->where("userid = '$userid'")->save($arr);
        $result3 = $user->where("userid = '$userid'")->find();

        //系统收取手续费
        $admin = M('admin');
        $result4 = $admin->where("adminid = 1")->find();
        $arr1 = array(
            'money'=>$result4['money']+$orderPrice*0.01  //系统收取 1%的手续费
        );
        $result5 = $admin->where("adminid = 1")->save($arr1);

        //添加订单
        $data =array(
            'bookName'=>$bookname,
            'orderPrice'=>$orderPrice,
            'sessionDate'=>$time,
            'userId'=>$userid,
            'orderAdress'=>$orderAdress,
            'orderPic'=>$orderPic,
            'orderstate'=>0
        );
        $result = $order->add($data);

        if ($result)
        {
            Response::json('1001','购买成功',$result3);
        }else
        {
            Response::json('-1001','购买失败');
        }
    }

    public function getOrderInfo()
    {
        $userid = I('post.userid');
        $orderstate = I('post.orderstate');
        $order = M('order');
        $data = $order->order("orderid DESC")->where("userid = '$userid' and orderstate = '$orderstate'")->select();
        if ($data)
        {
            Response::json('1001','获取订单成功',$data);
        }else
        {
            Response::json('-1001','获取订单成功');
        }
    }

    public function addOrder2()
    {
        //接收数据
        $bookid = I('post.bookid');
        $bookname = I('post.bookName');
        $orderPrice = I('post.orderPrice');
        $userid = I('post.userId');
        $ownUserid = I('post.ownUserid');
        $orderAdress = I('post.orderAdress');
        $orderPic = I('post.orderPic');
        $time = date("Y-m-d H:i",time());

        $order = M('order');

        //用户扣钱
        $user = M('user');
        $result1 = $user->where("userid = '$userid'")->find();
        $arr = array(
            'money'=>$result1['money']-$orderPrice
        );
        $result2 = $user->where("userid = '$userid'")->save($arr);
        $result3 = $user->where("userid = '$userid'")->find();

        //系统收取手续费
        $admin = M('admin');
        $result4 = $admin->where("adminid = 1")->find();
        $arr1 = array(
            'money'=>$result4['money']+$orderPrice*0.01  //系统收取 1%的手续费
        );
        $result5 = $admin->where("adminid = 1")->save($arr1);

        //发布二手书用户加钱
        $user = M('user');
        $result6 = $user->where("userid = '$ownUserid'")->find();
        $arr2 = array(
            'money'=>$result6['money']+($orderPrice-$orderPrice*0.01)
        );
        $result7 = $user->where("userid = '$ownUserid'")->save($arr2);

        //添加订单
        $data =array(
            'bookName'=>$bookname,
            'orderPrice'=>$orderPrice,
            'sessionDate'=>$time,
            'userId'=>$userid,
            'orderAdress'=>$orderAdress,
            'orderPic'=>$orderPic,
            'orderstate'=>0
        );
        $result = $order->add($data);

        if ($result)
        {
            $oldbook = M('oldbook');
            $result8 = $oldbook->where("bookid  = '$bookid'")->delete();

            //通知发布者信息
            $notice = M('notice');
            $arr3 = array(
                'noticename'=>'管理员',
                'noticecontent'=>"恭喜！您上传的《{$bookname}》已被{$result1['nickname']}购买，收益已存入您的余额！
                订单地址为：{$orderAdress}，联系方式为：{$result1['phone']}，为了您的信用请尽快派送
                ",
                'time'=>$time,
                'userid'=>$ownUserid,
                'noticetitle'=>'系统'
            );
            $result9 = $notice->add($arr3);
            Response::json('1001','购买成功',$result3);
        }else
        {
            Response::json('-1001','购买失败');
        }
    }


}