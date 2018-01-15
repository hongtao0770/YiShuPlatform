<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/4
 * Time: 9:39
 */
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller
{

//    public function index()
//    {
//        $this->display;
//    }
    //登录验证
    public function loginCheck(){

        $admin = M('admin');
        $adminname = I('post.adminname');// $username = $_POST['username'];
        $password = md5(I('post.adminpassword'));

        $result = $admin->where("adminname = '%s' AND adminpassword = '%s'",$adminname
            ,$password )->find();
//        var_dump($result);
        if($result){

            $_SESSION['adminname'] = $adminname;
            $ip = get_client_ip();
            $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
            $area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
            $admin = M('admin');
            $time = date("Y-m-d H:i:s",time());
            $_SESSION['time'] = $time;
            $result = $admin->where("adminname = '{$_SESSION['adminname']}'")->find();
            $_SESSION['adminid'] = $result['adminid'];
            $data1 = array(
                'adminname'=>$_SESSION['adminname'],
                'ip'=>$ip,
                'time'=>$time,
                'country'=>$area['country'],
                'count'=>$result['count']+1
            );
            $adminlog = M('adminlog');
            $data = $adminlog->add($data1);
            $data=array(
                'code'=>200,
                'msg'=>'登录成功'
            );
            $data1 = array(
                'count'=>$result['count']+1
            );
            $count = $admin->where("adminname = '$adminname'")->save($data1);
            $this->ajaxReturn($data,'JSON');
        }else{
            $data=array(
                'code'=>0,
                'msg'=>'登录失败'
            );
            $this->ajaxReturn($data,'JSON');
        }

    }
    //退出系统
    public function logout()
    {
        session(null);

       $data = array(
           'code'=>200,
           'msg'=>'退出成功！'
       );
        $this->ajaxReturn($data,'JSON');
    }

    //系统设置口令验证
    public function Koulin()
    {
        $koulin = md5(I('post.pass'));
        $admin = M('admin');
        $data = $admin->where("token = '$koulin'")->select();
        if ($data)
        {
            $data=array(
                'code'=>200,
                'msg'=>'口令正确！'
            );
            $this->ajaxReturn($data,'JSON');
        }else
        {
            $data2=array(
                'code'=>0,
                'msg'=>'口令错误！'
            );
            $this->ajaxReturn($data2,'JSON');
        }
    }
}