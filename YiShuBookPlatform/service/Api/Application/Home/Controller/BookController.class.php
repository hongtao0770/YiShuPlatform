<?php
/**
 * Created by PhpStorm.
 * User: 洪涛
 * Date: 2017/12/26
 * Time: 10:36
 */
namespace Home\Controller;
use Home\Common\Response;
use Home\Controller;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置

class BookController extends \Think\Controller
{

    //获取所有最新图书
    function getAllBooks()
    {
        $books = M('book');
        $data =$books->select();

        if ($data)
        {
            Response::json('1001','获取所有图书成功',$data);
        }else
        {
            Response::json('-1001','获取所有图书失败');
        }
    }

    //获取二手书
    function getOldBooks()
    {
        $books = M('oldbook');
        $data = $books->query("select y_user.nickname,y_oldbook.*from y_user,y_oldbook where y_oldbook.userid = y_user.userid");
        if ($data)
        {
            Response::json('1001','获取图书成功',$data);
        }else{
            Response::json('-1001','获取图书失败');
        }
    }


    //根据图书ID 查找图书
    function getBooksById()
    {
        $books = M('book');
        $bookId = I('post.bookId');
        $data = $books->where("bookId = '$bookId'")->find();
        if ($data)
        {
            Response::json('1001','获取图书成功',$data);
        }else{
            Response::json('-1001','获取图书失败');
        }

    }

    //获取打折图书
    function getBooksOnSale($bookSale)
    {
        $books = M('book');
        $data = $books->where("bookSale = '$bookSale'")->select();
        if ($data)
        {
            Response::json('1001','获取图书成功',$data);
        }else{
            Response::json('-1001','获取图书失败');
        }
    }

    function getBookCard($bookShow)
    {
        $books = M('book');
        $data = $books->where("bookShow = '$bookShow'")->select();
        if ($data)
        {
            Response::json('1001','获取图书成功',$data);
        }else{
            Response::json('-1001','获取图书失败');
        }
    }

    function getRank()
    {
        $rank = M('ranklist');
        $result = $rank->select();
        if ($result)
        {
            Response::json('1001','获取排行榜成功',$result);
        }else{
            Response::json('-1001','获取排行榜失败');
        }
    }

}