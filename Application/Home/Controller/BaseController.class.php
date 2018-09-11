<?php
/**
 * 工程基类
 * @since   2017/02/28 创建
 * @author  zhaoxiang <zhaoxiang051405@gmail.com>
 */

namespace Home\Controller;


use Think\Controller;

class BaseController extends Controller {

    public function _initialize(){
        // 读取数据库中读取参数字典
        $config_dict = S('DB_CONFIG_DICT_DATA');
        if (!$config_dict) {
            $config_dict = D('Admin/ApiConfigDict')->getDictLists();
            S('DB_CONFIG_DICT_DATA', $config_dict);
        }
        // 添加配置
        C($config_dict);

        //添加网站设置配置
        D('Admin/api_config')->setConfig();
    }
}