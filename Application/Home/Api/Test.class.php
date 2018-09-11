<?php

/**
 *
 * @since   2017/03/10 创建
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace Home\Api;

use Home\ORG\JPush;
use Home\ORG\Response;
use Think\Upload;

class Test extends Base {

    public function index() {

    }

    public function getRandNum($param)
    {

        $userToken = D('Token')->setToken(1);
        return $userToken;
    	return $return['rand'] = "1001";
    }

}