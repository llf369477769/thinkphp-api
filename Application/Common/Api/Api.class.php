<?php

namespace Common\Api;


//载入配置文件
//require_cache(UC_CLIENT_PATH . '/Conf/config.php');
//载入函数库文件
//require_cache(UC_CLIENT_PATH . '/Common/common.php');

/**
 * UC API调用控制器层
 * 调用方法 A('Uc/User', 'Api')->login($username, $password, $type);
 */
abstract class Api {

    /**
     * 构造方法，检测相关配置
     */
    public function __construct() {


        $this->init();
    }

    /**
     * 抽象方法，用于设置模型实例
     */
    abstract protected function init();

    /**
     * API公共返回数据方法
     * 
     * @param integer $code （00：表示成功，其余表示失败相关错误代码）
     * @param string $msg
     * @param mixed $data
     * @return array
     */
    protected function response($code = '00', $msg = '', $data = array()) {
        return array('code' => $code, 'data' => $data, 'erro' => $msg);
    }

}
