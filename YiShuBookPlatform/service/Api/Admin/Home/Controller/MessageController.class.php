<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2018/1/3
 * Time: 17:10
 */
namespace Home\Controller;
use Think\Controller;

class MessageController extends CommonController
{
    public function index()
    {
        $message = M('message');
        $count = $message->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $message
            ->order('messageid DESC')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->field('y_user.phone,y_user.nickname,y_message.*')
            ->join('y_user on y_message.userid=y_user.userid')
            ->select();
        $this->assign("list", $b);
        $this->assign('page', $show);
        $this->display();
    }
    //删除邮件
    public function delete()
    {
        $message = D('message');
        $messageid = I('post.messageid');
        $result = $message->where("messageid = '$messageid'")->delete();
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
    public function add()
    {
        $user = M('user');
        $data = $user->query("select y_user.userid,y_user.nickname from y_user");
        $this->assign("list", $data);
        $this->display();
    }
    //添加邮件
    public function doadd()
    {
        $notice = M('notice');
        $data = $notice->create();
        $data['time'] = date("Y-m-d H:i",time());
        $data['noticename'] = "管理员";
        if($data['userid']==0)
        {
            $user = M('user');
            $count = $user->count();
            $ids = $user->field('userid')->order('userid DESC')->select();
            //var_dump($ids[0]['userid']);
            for ($i=0;$i<$count;$i++)
            {
                $data['userid'] = $ids[$i]['userid'];
                $result2 = $notice->add($data);
            }
            $data = array(
                'code'=>200,
                'msg'=>'发送成功！'
            );
            $this->ajaxReturn($data,'JSON');
        }else
        {
            $result = $notice->add($data);
            if ($result) {
                $data = array(
                    'code'=>200,
                    'msg'=>'发送成功！'
                );
                $this->ajaxReturn($data,'JSON');
            } else {
                $data = array(
                    'code'=>0,
                    'msg'=>'发送失败！'
                );
                $this->ajaxReturn($data,'JSON');
            }
        }

    }
    //查看邮件详细信息
    public function look()
    {
        $messageid = I('post.id');
        $message = M('message');
        $result = $message
            ->where("messageid = $messageid")
            ->field('y_user.nickname,y_message.*')
            ->join('y_user on y_message.userid = y_user.userid')
            ->find();
        if ($result)
        {
            $da =array(
                'state'=>1
            );
            $result2 = $message->where("messageid = $messageid")->save($da);

            $data = array(
                'code'=>200,
                'mgs'=>$result['messagecontent'],
                'time'=>$result['messagetime'],
                'name'=>$result['nickname'],
            );
            $this->ajaxReturn($data,'json');
        }
    }
    //批量删除
    public function deletes(){
        $message = D('message');
        $deletes = $_REQUEST['deletes'];
        $deletes = implode(',', $deletes);
        $result = $message->delete($deletes);
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