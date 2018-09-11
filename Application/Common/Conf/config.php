<?php

return array(
    'URL_MODEL' => 2,

    'APP_VERSION' => 'v1.0',
    'APP_NAME'    => '植慧 - 逆龄时光',

    'USER_ADMINISTRATOR' => array(1,2),
    'AUTH_KEY' => 'I&TC{pft>L,C`wFQ>&#ROW>k{Kxlt1>ryW(>r<#R',

    'COMPANY_NAME' => '深圳市吉图软件开发有限公司',

    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES' => array(
        'wiki/:hash'  => 'Home/Wiki/apiField',
        'api/:hash'   => 'Home/Api/index',
        'wikiList'    => 'Home/Wiki/apiList',
        'errorList'   => 'Home/Wiki/errorCode',
        'calculation' => 'Home/Wiki/calculation'
    ),

    'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'LANG_LIST'      => 'zh-cn', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'   => 'l', // 默认语言切换变量


    'LOAD_EXT_CONFIG'=>'upload,redis', //加载配置文件


    /* 数据库设置 */
    'DB_TYPE'        => 'mysql',     // 数据库类型
    'DB_HOST'        => '192.168.1.210',     // 服务器地址   192.168.1.210    //127.0.0.1
    'DB_NAME'        => 'zhihui',          // 数据库名  huaan    //apiadmin
    'DB_USER'        => 'root',      // 用户名  root   //homestead
    'DB_PWD'         => 'root',          // 密码   root   //secret


    'ONLINE_TIME'=>43200,   //在线过期时间


    'HUAAN_URL'=>'http://zhihui.com/',

);

