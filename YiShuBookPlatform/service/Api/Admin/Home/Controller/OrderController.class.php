<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 20:56
 */
namespace Home\Controller;
use Think\Controller;

class OrderController extends CommonController
{
    public function index()
    {
        $order = M('order');
        $count = $order->where("orderstate = 0")->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $order
            ->order('orderid DESC')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->field('y_user.phone,y_user.nickname,y_order.*')
            ->join('y_user on y_order.userId = y_user.userid')
            ->where("orderstate = 0")
            ->select();
        $this->assign('list', $b);
        $this->assign('page', $show);

        $c = $order
            ->order('orderid DESC')
            ->field('y_user.phone,y_user.nickname,y_order.*')
            ->join('y_user on y_order.userId = y_user.userid')
            ->where("orderstate = 1")
            ->select();
        $this->assign('list1', $c);


        $this->display();
    }


    public function edit($orderid)
    {
        $order = D('order');
        $b = $order->find($orderid);
        $this->assign('list', $b);
        $this->display();
    }
    //修改订单
    public function doedit()
    {
        $order = D('order');
        $data = $order->create();
        $result = $order->save($data);
        if ($result > 0) {
            $data = array(
                'code'=>200,
                'msg'=>'修改成功！'
            );
            $this->ajaxReturn($data,'JSON');
        } else {
            $data = array(
                'code'=>0,
                'msg'=>'修改失败！'
            );
            $this->ajaxReturn($data,'JSON');
        }
    }

    //删除订单
    public function delete()
    {
        $order = M('order');
        $orderid = I('post.orderid');
        $result = $order->where("orderid = '$orderid'")->delete();
        if ($result) {
            $data = array(
                'code'=>200,
                'msg'=>'删除成功！'
            );
            $this->ajaxReturn($data,'JSON');
        } else {
            $data = array(
                'code'=>0,
                'msg'=>'删除失败！'
            );
            $this->ajaxReturn($data,'JSON');
        }
    }

    //更改订单状态
    public function action()
    {
        $orderid = I('post.orderid');
        $order = M('order');
        $arr = array(
            'orderstate'=>1
        );
        $result = $order->where("orderid = '$orderid'")->save($arr);
        if ($result)
        {
            $data = array(
                'code'=>200,
                'msg'=>'发货成功！已通知快递公司取件！'
            );
            $this->ajaxReturn($data,'JSON');
        }
        else{
            $data = array(
                'code'=>0,
                'msg'=>'发货失败！'
            );
            $this->ajaxReturn($data,'JSON');
        }


    }
}
