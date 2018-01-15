<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/6
 * Time: 11:16
 */
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller
{
    function _initialize()
    {
        $member = D('admin');
        $arr = $member->where("adminname = '%s'", $_SESSION['adminname'])->find();
        if ($_SESSION['adminname'] == "" || $arr == null) {
            header('location:' . U('Login/index'));
        }
    }
    public function myRelust($result)
    {
        if ($result == false) {
            $this->error("操作失败！");
        } else {
            $this->success("操作成功！",U('Login/index'),3);
        }
    }

    function is_pjax(){
        if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
            //浏览器支持pjax，直接输出模板
            parent::display();
        } else {
            //浏览器不支持pjax，开启模板布局功能，拼接html
            layout(true);
            parent::display();
        }
    }



}