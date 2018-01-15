<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28
 * Time: 15:56
 */
namespace Home\Controller;
use Think\Controller;

class UserController extends CommonController
{
    public function index()
    {
        $user = D('user');
        $count = $user->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $user->order('userid ASC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $b);
        $this->assign('page', $show);
        $this->display();
    }

    public function edit($userid)
    {
        $user = D('user');
        $data = $user->where("userid = '$userid'")->find();
        $this->assign('l', $data);
        $this->display();
    }

    //修改用户
    public function doedit()
    {
        $user = M('user');
        $data = $user->create();
        if ($_FILES['picture']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['picture']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['picture'] = $info['savepath'] . $info['savename'];
            }
        }
        $result = $user->where("userid = {$data['userid']}")->save($data);

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

    //更改用户状态
    public function action()
    {
        $userid = I('post.userid');
        $user = M('user');
        $data = $user->where("userid = '$userid'")->find();
        //var_dump($data['state']);
        if ($data['state'] == 1)
        {
            $da =array(
                'state'=>0
            );
            $oldbook = M('oldbook');
            $result1 = $oldbook->where("userid = '$userid'")->delete();
            $result = $user->where("userid = '$userid'")->save($da);

            $this->ajaxReturn(0);

        }elseif($data['state'] == 0)
        {
            $ds =array(
                'state'=>1
            );
            $result = $user->where("userid = '$userid'")->save($ds);
            $response = 1;
            $this->ajaxReturn(1);
        }
    }

}