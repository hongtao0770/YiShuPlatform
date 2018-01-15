<?php

/**
 * Response 响应类，用于以json格式返回数据请求响应信息
 *
 * @param string $code 状态码
 * @param string $message 响应信息
 * @param array $data 具体数据
 * @return json
 */
namespace Home\Common;
class Response
{
    public static function json($code = '', $message = '', $data = array())
    {
        $result = array(
            'code' => $code,
            'message' => $message,
            'content' => $data
        );
        exit(json_encode($result));
    }

    public static function json2($code = '', $message = '', $data = array())
    {
        $result = array(
            'code' => urlencode($code),
            'message' => urlencode($message),
            'content' => self::encodeArray($data)
        );
        exit(urldecode(json_encode($result,JSON_FORCE_OBJECT)));
    }

//    public static function json($code = '', $message = '', $date = array())
//    {
//        $result = array(
//            'code' => urlencode($code),
//            'message' => urlencode($message),
//            'content' => self::encodeArray($date)
//        );
//        exit(urldecode(json_encode($result,JSON_FORCE_OBJECT)));
//    }
//
    public static function encodeArray($arr = array())
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $arr[$key] = self::encodeArray($value);
            } else {
                $arr[$key] = urlencode($value);
            }
        }
        return $arr;
    }
}
