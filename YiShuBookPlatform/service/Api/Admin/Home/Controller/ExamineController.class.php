<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2018/1/3
 * Time: 14:38
 */
namespace Home\Controller;
use Think\Controller;

class ExamineController extends CommonController
{
    public function index()
    {
        $examine = M('examine');
        $a = $examine->query("SELECT y_user.phone,y_user.nickname,y_examine.* from y_examine,y_user WHERE y_examine.userid = y_user.userid AND y_examine.state =0 ORDER BY y_examine.examineid DESC ");
        $this->assign("list1", $a);
        $b =$examine->query("SELECT y_user.phone,y_user.nickname,y_examine.* from y_examine,y_user WHERE y_examine.userid = y_user.userid AND y_examine.state =1 ORDER BY y_examine.examineid ASC ");
        $this->assign("list2", $b);
        $c = $examine->query("SELECT y_user.phone,y_user.nickname,y_examine.* from y_examine,y_user WHERE y_examine.userid = y_user.userid AND y_examine.state =2 ORDER BY y_examine.examineid ASC ");
        $this->assign("list3", $c);
        $this->display();
    }

    //审核通过
    public function doexamineT()
    {
        $examineid = I('post.examineid');
        $examine = M('examine');
        $arr = array(
            'state'=>1
        );
        $result = $examine->where("examineid = '$examineid'")->save($arr);
        if ($result)
        {
            //1.向用户发送消息
            $result2 = $examine->where("examineid = '$examineid'")->find();
            $notice = M('notice');
            $data1 = array(
                'noticename'=>'管理员',
                'noticecontent'=>"恭喜！您于{$result2['time']} 上传的《{$result2['bookname']}》已通过审核，正式上架！",
                'time'=>date("Y-m-d H:i",time()),
                'userid'=>$result2['userid'],
                'noticetitle'=>'管理员'
            );
            $result3 = $notice->add($data1);
            //2.将图书上架
            $oldbook = M('oldbook');
            $data2 = array(
                'bookname'=>$result2['bookname'],
                'bookprice'=>$result2['bookprice'],
                'bookposter'=>$result2['bookposter'],
                'bookcontent'=>$result2['bookcontent'],
                'booktype'=>$result2['booktype'],
                'userid'=>$result2['userid']
            );
            $result4 = $oldbook->add($data2);
            $data = array(
                'code'=>200,
                'msg'=>"审核通过！"
            );
            $this->ajaxReturn($data,'JSON');
        }else
        {
            $data = array(
                'code'=>0,
                'msg'=>"审核出现错误！"
            );
            $this->ajaxReturn($data,'JSON');
        }
    }

    //审核不通过
    public function doexamineP()
    {
        $examineid = I('post.examineid');
        $examine = M('examine');
        $arr = array(
            'state'=>2
        );
        $result = $examine->where("examineid = '$examineid'")->save($arr);
        if ($result)
        {
            //1.向用户发送消息
            $result2 = $examine->where("examineid = '$examineid'")->find();
            $notice = M('notice');
            $data1 = array(
                'noticename'=>'管理员',
                'noticecontent'=>"抱歉很遗憾！您于{$result2['time']} 上传的《{$result2['bookname']}》未通过审核，具体问题请联系管理员！",
                'time'=>date("Y-m-d H:i",time()),
                'userid'=>$result2['userid'],
                'noticetitle'=>'管理员'
            );
            $result3 = $notice->add($data1);
            $data = array(
                'code'=>200,
                'msg'=>"审核未通过！"
            );
            $this->ajaxReturn($data,'JSON');
        }else
        {
            $data = array(
                'code'=>0,
                'msg'=>"通过失败！"
            );
            $this->ajaxReturn($data,'JSON');
        }
    }

    //删除审核
    public function delete()
    {
        $examine= M('examine');
        $examineid = I('post.examineid');
        $result = $examine->where("examineid = '$examineid'")->delete();
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

    //放大图片
    public function img()
    {
        $examine = M("examine");
        $examineid = I('post.examineid');
        $result = $examine->where("examineid = '$examineid'")->find();
        if ($result)
        {
            $data = array(
                'code'=>200,
                'mgs'=>$result['bookposter']
            );
            $this->ajaxReturn($data,'json');
        }
    }
}
