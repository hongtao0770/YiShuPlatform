<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 20:56
 */
namespace Home\Controller;
use Think\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        $activity = D('activity');
        $count = $activity->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $activity->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $b);
        $this->assign('page', $show);

        $this->display();
    }
    public function add()
    {
        $activity = D('activity');
        $this->display();
    }
    public function doadd()
    {
        $activity = D('activity');
        $data = $activity->create();
        $data['time'] = time();
        if ($_FILES['activityposter']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['activityposter']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['activityposter'] = $info['savepath'] . $info['savename'];
            }
        }
        $result = $activity->add($data);
        if ($result > 0) {
            $data = array(
                'code'=>200,
                'msg'=>'添加成功！'
            );
            $this->ajaxReturn($data,'JSON');
        } else {
            $data = array(
                'code'=>0,
                'msg'=>'添加失败！'
            );
            $this->ajaxReturn($data,'JSON');
        }
    }
    public function edit($activityid)
    {
        $activity = D('activity');
        $b = $activity->find($activityid);
        $this->assign('list', $b);
        $this->display();
    }
    public function doedit()
    {
        $activity = M('activity');
        $data = $activity->create();
        if ($_FILES['activityposter']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['activityposter']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['activityposter'] = $info['savepath'] . $info['savename'];
            }
        }
        $result = $activity->save($data);
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



    public function delete()
    {
        $activity = M('activity');
        $activityid = I('post.activityid');
        $result = $activity->where("activityid = '$activityid'")->delete();
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
