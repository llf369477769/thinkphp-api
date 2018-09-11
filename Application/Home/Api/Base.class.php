<?php
/**
 *
 * @since   2017/03/02 创建
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace Home\Api;

use Home\ORG\Response;

class Base {

    protected $city;
    protected $userInfo;

    //protected $userId = false;//用户id

    public function __construct() {
        $this->city = C('CITY');
        $this->userInfo = C('USER_INFO');
    }


    /**
     * 校验Token是否合法
     * @param  string $token Token令牌
     * @return bool   令牌是否合法
     */
//    protected function auth($token = null, $uid = null) {
//        $token = empty($token) ? I('token') : $token;
//        $uid = empty($uid) ? I('uid') : $uid;
//
//        if (empty($token)) {
//            // 令牌不存在
//            Response::error(1000);
//            return false;
//        }
//
//        if (empty($uid)) {
//            // 缺少用户参数UID
//            Response::error(1005);
//            return false;
//        }
//
//        $verifyToken = D('Token')->authToken($token);
//        if (!$verifyToken['is_verify']) {
//            // 令牌不合法或者已经失效
//            Response::error(1001);
//            return false;
//        }
//        // 令牌验证通过,验证令牌里的UID与用户传过来的UID是否一致
//        if ($verifyToken['token_decode']['uid'] != $uid) {
//            Response::error(1003);
//            return false;
//        }
//        $this->userId = $uid; //定义用户id
//        return true;
//    }
}