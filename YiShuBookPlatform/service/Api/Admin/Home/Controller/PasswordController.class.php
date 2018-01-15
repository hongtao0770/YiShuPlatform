<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 20:56
 */
namespace Home\Controller;
use Think\Controller;

class PasswordController extends CommonController
{
    public function index()
    {
        $this->display();
    }

    //管理员更改密码
    public function doUpdate()
    {
        $pass1 =I('post.pass1');
        $pass2 = I('post.pass2');


            if ($pass1 == $pass2)
            {
                $admin = M("admin");
                $arr = array(
                    'adminpassword'=>md5($pass1)
                );
                $result = $admin->where("adminid = {$_SESSION['adminid']}")->save($arr);
                if ($result)
                {
                    $data = array(
                        'code'=>200,
                        'msg'=>'修改密码成功！'
                    );
                    session(null);

                    $this->ajaxReturn($data,'JSON');
                }else
                {
                    $data = array(
                        'code'=>0,
                        'msg'=>'修改密码失败！'
                    );
                    $this->ajaxReturn($data,'JSON');
                }

            }else
            {
                $data = array(
                    'code'=>0,
                    'msg'=>'确认密码有误！'
                );
                $this->ajaxReturn($data,'JSON');
            }


    }
}