<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 20:56
 */
namespace Home\Controller;
use Think\Controller;

class BookController extends CommonController
{
    public function index()
    {
        $book = M('book');
        $count = $book->count();
        $Page = new \Think\Page($count, 5);
        $show = $Page->show();
        $b = $book->order('bookId ASC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $b);
        $this->assign('page', $show);

        $ranklist = M('ranklist');
        $c = $ranklist->select();
        $this->assign('list2', $c);
        $this->display();
    }
    public function add()
    {
        $book = M('book');
        $this->display();
    }
    public function doadd()
    {
        $book = M('book');
        $data = $book->create();
        $data['time'] = time();
        if ($_FILES['bookPoster']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['bookPoster']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['bookPoster'] = $info['savepath'] . $info['savename'];
            }
        }
        $data['salesnum'] = 0;
        $result = $book->add($data);
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
    public function edit($bookid)
    {
//        $links = D('links');
//        $l = $links->find($id);
//        $this->assign('l', $l);
//        $this->display();

        $book = M('book');
        $b = $book->find($bookid);
        $this->assign('list', $b);
        $this->display();
    }
    public function doedit()
    {
        $book = M('book');
        $data = $book->create();
        if ($_FILES['bookPoster']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath = './Uploads/';
            $upload->savePath = '/';
            $info = $upload->uploadOne($_FILES['bookPoster']);
            if (!$info) {
                $this->error($upload->getError());
            } else {
                $data['bookPoster'] = $info['savepath'] . $info['savename'];
            }
        }
        $result = $book->save($data);
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
        $book = M('book');
        $bookid = I('post.bookid');
        $result = $book->where("bookid = '$bookid'")->delete();
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

    public function img()
    {
        $book = M("book");
        $bookId = I('post.bookId');
        $result = $book->where("bookId = '$bookId'")->find();
        if ($result)
        {
            $data = array(
                'code'=>200,
                'mgs'=>$result['bookposter']
            );
            $this->ajaxReturn($data,'json');
        }
    }

    public function rank()
    {
        $book = M('book');
        $result = $book
            ->order('salesnum DESC')
            ->limit(0,5)
            ->field('bookId,bookName,bookPoster')
            ->select();

        $ranklist = M('ranklist');
        $ids = $ranklist->field('rank')->select();
        $count = $ranklist->count();

//        var_dump($result[0]["bookid"]);
//        var_dump($result[0]["bookname"]);
//        var_dump($result[0]["bookposter"]);
//        var_dump($ids);
       for ($i = 0;$i<$count;$i++)
        {
            $arr = array(
                'bookId'=>$result[$i]["bookid"],
                'bookname'=>$result[$i]["bookname"],
                'bookposter'=>$result[$i]["bookposter"]
            );
            $result1 = $ranklist->where("ranklist = {$ids[$i]['rank']}")->save($arr);
        }
            $data = array(
                'code'=>200,
                'msg'=>'更新排行榜成功！'
            );
            $this->ajaxReturn($data,'JSON');
    }
}


