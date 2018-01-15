<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/26
 * Time: 19:44
 */
namespace Home\Controller;
use Home\Common\Response;
use Home\Controller;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class FriendCircleController extends \Think\Controller
{

    //获取所有动态
    public function getDynamic()
    {
//        $dynamic = M('friend');
//        $data = $dynamic->query("select y_friend.id,y_friend.content,y_friend.fabulous,y_friend.time,y_user.nickname,y_user.picture from y_friend,y_user where y_friend.userid = y_user.userid ORDER BY y_friend.id DESC");
////        var_dump($data);
//        if ($data)
//        {
//            Response::json('1001','获取所有动态成功',$data);
//        }else
//        {
//            Response::json('-1001','获取所有动态失败');
//        }

//        1、获取动态条数
        $frind = M('friend');
        $ids = $frind->field('id')->order('id DESC')->select();
        $data = array();
        foreach ($ids as $val) {
            $dym = $frind
                ->where("id = {$val['id']}")
                ->join("y_user on y_friend.userid = y_user.userid")
                ->select();
            $comment = M('common')
                ->where("fid = {$val['id']}")
                ->join("y_user on y_common.userid = y_user.userid")
                ->select();
            $dym = array_reduce($dym,  'array_merge', array());
            $dym['comment'] = $comment;
//            $obj = array_reduce($dym,  'array_merge', array());
            array_push($data, $dym);
//            var_dump($dym);
//            break;
        }
//        $data = array_reduce($data,  'array_merge', array());
            if ($data)
            {
                Response::json('1001','获取所有动态成功',$data);
            }else
            {
                Response::json('-1001','获取所有动态失败');
            }


    }

    //用户发表动态
    public function addDynamic()
    {
        $userid = I('post.userid');
        $content = I('post.content');
        $dynamic = M('friend');
        $time = date("Y-m-d H:i",time());
        $data1 = array(
            'content'=>$content,
            'fabulous'=>0,
            'userid'=>$userid,
            'time'=>$time
        );
        $result = $dynamic->add($data1);
        if ($result)
        {
            Response::json2('1001','发表动态成功',$result);
        }else
        {
            Response::json2('-1001','发表动态失败');
        }
    }


    //添加评论
    public function addCommon()
    {
        $content = I('post.common');
        $fid = I('post.fid');
        $userid = I('post.userid');
        $common = M('common');
        $data = array(
            'commonContent'=>$content,
            'fid'=>$fid,
            'userid'=>$userid,
        );
        $result = $common->add($data);
        if ($result){
            Response::json('1001','评论成功');
        }else{
            Response::json('-1001','评论失败');
        }
    }

    //点赞
    public function addFabulous()
    {
        $id = I('post.id');
        $friend = M('friend');
        $result = $friend->where("id = '$id'")->select();
        $fabulous = $result[0]['fabulous'];
//        var_dump((int)$result[0]['fabulous']);
        $data = array(
            'fabulous'=>$fabulous + 1
        );
        $result = $friend->where("id = '$id'")->save($data);
        if ($result)
        {
            Response::json('1001','点赞成功',$result);
        }else
        {
            Response::json('-1001','点赞失败');
        }
    }

    public function getFriends()
    {
        $userid = I('post.userid');
        $friend = M('friend');
        $data = $friend->where("userid = '$userid'")->select();
        if ($data)
        {
            Response::json('1001','获取动态成功',$data);
        }else
        {
            Response::json('-1001','获取动态失败');
        }
    }

//    public function test()
//    {
//        $friend = M('friend');
//        $data = $friend->where("id = 46")->select();
//        $time = time();
////        echo $time."<br/>";
//
//        echo date("Y-m-d H:i",$data[0]["time"]);
//    }

       public function delete()
       {
           $id = I('post.id');
           $friend = M('friend');
           $common = M('common');
           $data1 = $common->where("fid = '$id'")->delete();
           $data2 = $friend->where("id = '$id'")->delete();
            if ($data2)
            {
                Response::json('1001','删除动态成功',$data2);
            }else
            {
                Response::json('-1001','删除动态失败');
            }

       }
}