<?php
/**
 * Created by PhpStorm.
 * User: wzj
 * Date: 2018/3/14
 * Time: 10:28
 */

namespace Admin\Model;

class ApiConfigModel extends BaseModel
{
    public function setConfig()
    {
        $site_config = M('api_config')->find();
        unset($site_config['id']);
        C($site_config);

    }

}