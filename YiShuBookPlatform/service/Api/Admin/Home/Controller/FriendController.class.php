<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 20:56
 */
namespace Home\Controller;
use Think\Controller;

class FriendController extends CommonController
{
    public function index()
    {
        $friend = M('friend');
        $count = $friend->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $friend
            ->order('id ASC')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->field('y_user.phone,y_user.nickname,y_friend.*')
            ->order('id DESC')
            ->join('y_user on y_user.userId = y_friend.userid')
            ->select();
        $this->assign('list', $b);
        $this->assign('page', $show);
        $this->display();
    }

    //书友圈动态删除
    public function delete()
    {
        $friend = M('friend');
        $id = I('post.id');
        $common = M('common');
        $result1 = $common->where("fid = '$id'")->delete();
        $result = $friend->where("id = '$id'")->delete();
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
}
