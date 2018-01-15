<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 20:56
 */
namespace Home\Controller;
use Think\Controller;

class OldbookController extends CommonController
{
    public function index()
    {
        $oldbook = D('oldbook');
        $count = $oldbook->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $oldbook
            ->order('bookid ASC')
            ->limit($Page->firstRow . ',' . $Page->listRows)
            ->field('y_user.phone,y_user.nickname,y_oldbook.*')
            ->join('y_user on y_oldbook.userid = y_user.userid')
            ->select();
//            ->query("SELECT y_user.phone,y_user.nickname,y_friend.* from y_user,y_friend WHERE y_user.userid = y_friend.userid");
        $this->assign('list', $b);
        $this->assign('page', $show);
        $this->display();
    }
    public function edit($bookid)
    {
        $oldbook = D('oldbook');
        $b = $oldbook
            ->field('y_user.phone,y_user.nickname,y_oldbook.*')
            ->join('y_user on y_oldbook.userid = y_user.userid')
            ->find($bookid);
        $this->assign('list', $b);
        $this->display();
    }
    //修改二手书信息
    public function doedit()
    {
        $oldbook = D('oldbook');
        $data = $oldbook->create();
        if ($_FILES['bookposter']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['bookposter']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['bookposter'] = $info['savepath'] . $info['savename'];
            }
        }
        $result = $oldbook->save($data);
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

    //删除二手书
    public function delete()
    {
        $oldbook = M('oldbook');
        $bookid = I('post.bookid');
        $result = $oldbook->where("bookid = '$bookid'")->delete();
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
        $book = M("oldbook");
        $bookid = I('post.bookId');
        $result = $book->where("bookid = '$bookid'")->find();
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
