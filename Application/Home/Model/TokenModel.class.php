<?php

/**
 * 用户Token类
 * 用户通过登录请求令牌，令牌设置有效期，在有效期内，通过客户端缓存令牌访问接口。
 */
namespace Home\Model;

use Think\Model;
use Firebase\JWT\JWT;

class TokenModel extends Model
{
    Protected $iss = 'http://jiajuan.cn';
    Protected $aud = 'app://jiajuan.cn';
    Protected $autoCheckFields = false;

    /**
     * token过期时间
     * @var integer
     */
    protected $exp_time;

    /**
     * 令牌时间余量
     * @var integer
     */
    protected $leeway   = 60;

    /**
     * 令牌签名秘钥，用于JWT签名
     * @var string
     */
    protected $secret_key = 'acVqNJZDsTgECxkpiKaHtRwcQgUDFFLP';

    /**
     * token验证结果
     * @var null
     */
    protected $result = [
                    'is_verify'    => false,  // 验证是否通过
                    'token'        => '',   // token令牌
                    'token_decode' => [],   // token解码后的数组
                    'message'      => '',   // 消息
                  ];

    function __construct()
    {
        $this->exp_time = NOW_TIME + 3600*24*15;
    }

    /**
     * 设置令牌
     * @param int $uid 用户ID
     * @return string
     */
    public function setToken($uid)
    {
        if (empty($uid)) {
            return false;
        }

        $key = C('TOKEN_SECRET_KEY');
        $token = array(
            "iss" => $this->iss,
            "aud" => $this->aud,
            "iat" => NOW_TIME,
            "nbf" => NOW_TIME,
            "uid" => $uid
        );
        return [ 'token' => JWT::encode($token, $key) ];
    }

    /**
     * 认证token
     * @param string $token
     * @return array|bool
     */
    public function authToken($token)
    {
        if (empty($token)) {
            return false;
        }

        $this->result['token'] = $token;

        try {
            $decoded = JWT::decode($token, C('TOKEN_SECRET_KEY'), array('HS256'));
            $result['token_decode'] = (array)$decoded;
            $result['is_verify'] = true;
        } catch (\Exception $e) {
            $result['message'] = '校验令牌出错，错误信息：' . $e->getMessage();
        }
        return $result;
    }

    /**
     * 过期当前token
     * @param string $token token值
     * @return bool
     */
    public function expToken($token)
    {
        // if ( $payload = $this->authToken($token) ) {
        //     $payload_array = (array) $decoded;
        //     $payload_array['exp'] = 0; // 清空过期时间，让令牌失效

        //     Vendor('Firebase.JWT.JWT');
        //     return \Firebase\JWT\JWT::encode($payload_array, $this->secret_key);
        // } else {
        //     return false;
        // }
    }
}
