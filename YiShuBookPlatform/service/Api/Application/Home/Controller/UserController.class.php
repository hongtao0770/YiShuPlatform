<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/26
 * Time: 16:10
 */
namespace Home\Controller;
use Home\Common\Response;
use Home\Controller;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class UserController extends \Think\Controller
{
    function getUserById()
    {
        $userid = I('post.userid');
        $user = M('user');
        $data = $user->where("userid = '$userid'")->find();
        if ($data)
        {
            Response::json('1001','获取用户成功',$data);
        }else
        {
            Response::json('-1001','获取用户失败');
        }
    }

    //修改资料
    public function saveInfo()
    {
        $userid = I('post.userid');
        $nickname = I('post.nickname');
        $address = I('post.address');
        $user = M('user');
        $data = array(
            'nickname'=>$nickname,
            'address'=>$address
        );
        $result1 = $user->where("userid = '$userid'")->save($data);
        if ($result1)
        {
           $result2 = $user->where("userid = '$userid'")->find();
           Response::json('1001','保存成功',$result2);
        }else
        {
            Response::json('-1001','保存失败');
        }
    }

    //修改密码
    public function editMima()
    {
        $phone = I('post.phone');
        $password = md5(I('post.password'));
        $user = M('user');
        $data = array(
            'password'=>$password
        );
        $result = $user->where("phone = '$phone'")->save($data);
        if ($result)
        {
            Response::json('1001','修改成功');
        }else
        {
            Response::json('-1001','修改失败');
        }
    }

    //上传头像
    public function upload()
    {
        $user = D('user');
        $data = $user->create();
        if ($_FILES['picture']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 0;
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
        $result = $user->where("userid = '{$data['userid']}'")->save($data);
        if ($result > 0) {
            $result2 = $user->where("userid = '{$data['userid']}'")->find();
            Response::json('1001','上传头像成功',$result2);
        } else {
            Response::json('1001','上传头像失败');
        }

    }

    //上传二手书
    public function uploadbook()
    {
        $examine = D('examine');
        $data = $examine->create();
        if ($_FILES['bookposter']['tmp_name'] != '') {
            $upload = new \Think\Upload();
            $upload->maxSize = 0;
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
        $data['state'] = 0;
        $data['time'] =  date("Y-m-d H:i",time());
        $result = $examine->add($data);
        if ($result > 0) {
            $result2 = $examine->where("userid = '{$data['userid']}'")->find();
            Response::json('1001','提交申请成功，等待审核通知！',$result2);
        } else {
            Response::json('1001','提交申请失败');
        }
    }

    //通过用户id获取用户通知
    public function getNoticeById()
    {
        $userid = I("post.userid");
        $notice = M('notice');
        $data = $notice->where("userid = '$userid'")->order("noticeid DESC")->select();
        if ($data)
        {
            Response::json('1001','获取通知成功',$data);
        }else
        {
            Response::json('-1001','获取通知失败');
        }
    }

    //删除通知
    public function deleteNotice()
    {
        $noticeid = I('post.noticeid');
        $notice = M('notice');
        $data = $notice->where("noticeid = '$noticeid'")->delete();
        if ($data)
        {
            Response::json('1001','删除通知成功',$data);
        }else
        {
            Response::json('-1001','删除通知失败');
        }
    }

    //发送邮件
    public function sendMessage()
    {
        $userid = I('post.userid');
        $messagecontent = I('post.messagecontent');
        $phone = I('post.phone');
        $message = M('message');
        $time = date("Y-m-d H:i",time());
        $data = array(
            'userid'=>$userid,
            'messagecontent'=>$messagecontent,
            'phone'=>$phone,
            'messagetime'=>$time,
            'state'=>0
        );
        $count = $message->where("userid = '$userid'")->count();
//        echo $count;
        if ($count>4)
        {
            Response::json('-1002','超过发送次数',$data);
        }else
        {
            $result = $message->add($data);
            if ($result)
            {
                Response::json('1001','发送成功，等待管理员回复！',$data);
            }else
            {
                Response::json('-1001','发送失败');
            }
        }

    }

    public function uploadRecord()
    {
       $userid = I('post.userid');
        $examine = M('examine');
        $data = $examine->where("userid = '$userid'")->order('examineid DESC')->select();

        if ($data)
        {
            Response::json('1001','获取记录成功',$data);
        }else
        {
            Response::json('-1001','获取记录失败');
        }
    }

    public function deleteRecord()
    {
        $examineid = I('post.examineid');
        $examine = M('examine');
        $data = $examine->where("examineid = '$examineid'")->delete();
        if ($data)
        {
            Response::json('1001','删除成功');
        }else
        {
            Response::json('-1001','删除失败');
        }
    }
}