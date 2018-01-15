<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2018/1/4
 * Time: 17:23
 */
namespace Home\Controller;
use Think\Controller;

class SystemController extends CommonController
{
    public function index()
    {
        $adminlog = M('adminlog');
        $count = $adminlog->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $adminlog->order("adminid DESC")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $system = M('system');
        $systemstate = $system->where("systemid = 1")->select();
        $this->assign("list1", $b);
        $this->assign("list2", $systemstate);
        $this->assign('page', $show);

        $admin = M('admin');
        $result = $admin->select();
        $this->assign('list3',$result);
        $order = M('order');
        $count1 = $order->count();
        $this->assign('list4',$count1);
        $user = M('user');
        $count2 = $user->count();
        $this->assign('list5',$count2);

        $this->display();
    }

    //关闭系统
    public function appSvc()
    {
        $system = M('system');
        $systemid = I('post.systemid');
        $result1 = $system->where("systemid = '$systemid'")->find();
        if ($result1['systemstate'] == 0)
        {
            $arr = array(
                'systemstate'=>1
            );
            $result2 = $system->where("systemid = '$systemid'")->save($arr);
            $data = array(
                'code'=>200,
                'msg'=>'关闭系统维护！',
                'response'=>1
            );

            //更改用户状态 2为1 开启系统
            $user = M('user');
            $state = 2;
            $ids = $user->field('userid')->order('userid DESC')->where("state = '$state'")->select();
            $count = $user->where("state = '$state'")->count();
            for ($i =0;$i<$count;$i++)
            {
                $arr2 = array(
                    'state'=>1
                );
                $result3 = $user->where("userid = {$ids[$i]['userid']}")->save($arr2);
            }


            $this->ajaxReturn($data,'JSON');
        }elseif ($result1['systemstate'] == 1)
        {
            $arr = array(
                'systemstate'=>0
            );
            $result2 = $system->where("systemid = '$systemid'")->save($arr);
            $data = array(
                'code'=>200,
                'msg'=>'开启系统维护！',
                'response'=>0
            );

            //更改用户状态 1为 2 关闭系统
            $user = M('user');
            $state = 1;
            $ids = $user->field('userid')->order('userid DESC')->where("state = '$state'")->select();
            $count = $user->where("state = '$state'")->count();
            for ($i =0;$i<$count;$i++)
            {
                $arr2 = array(
                    'state'=>2
                );
                $result3 = $user->where("userid = {$ids[$i]['userid']}")->save($arr2);
            }

            //返回数据
            $this->ajaxReturn($data,'JSON');
        }

    }

    //删除日志
    public function delete()
    {
        $adminlog = M('adminlog');
        $adminid = I('post.adminid');
        $result = $adminlog->where("adminid = '$adminid'")->delete();
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

    public function getAllBook()
    {
        $book = M('book');
        $count = $book->count();
        $result = $book->field("y_book.bookname,y_book.salesnum")->select();
        for($i = 0;$i<$count;$i++)
        {
            $data = array(
                'bookname'=>$result[$i]['bookname'],
                'salesnum'=>$result[$i]['salesnum']
            );
        }
        $this->ajaxReturn($data,'JSON');
//        var_dump($data);
    }

    //批量删除
    public function deletes(){
        $adminlog = M('adminlog');
        $deletes = $_REQUEST['deletes'];
        $deletes = implode(',', $deletes);
        $result = $adminlog->delete($deletes);
        if($result){
            $data = array(
                'code'=>200,
                'msg'=>"删除成功！"
            );
            $this->ajaxReturn($data,'json');
        }else{
            $data = array(
                'code'=>0,
                'msg'=>"删除失败！"
            );
            $this->ajaxReturn($data,'json');
        }

    }
}