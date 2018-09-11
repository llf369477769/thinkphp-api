<?php
/**
 * Created by PhpStorm.
 * User: jitu
 * Date: 2018/3/31
 * Time: 11:37
 */

return [
    // Redis配置
    'REDIS_HOST'=>'127.0.0.1',
    'REDIS_PORT'=>6379,
    'DATA_CACHE_TIMEOUT'=>60, //连接超时时间
    'REDIS_AUTH'=>null,
    'REDIS_DBNAME'=>'Zhihui:Cache:',

    // Cache配置
    'DATA_CACHE_TIME'       =>  0,      // 数据缓存有效期 0表示永久缓存
    'DATA_CACHE_COMPRESS'   =>  false,   // 数据缓存是否压缩缓存
    'DATA_CACHE_CHECK'      =>  false,   // 数据缓存是否校验缓存
    'DATA_CACHE_PREFIX'     =>  'Zhihui:Cache:',     // 缓存前缀
    'DATA_CACHE_TYPE'       =>  'Redis',  // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator

    //Redis Session配置
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
    'SESSION_TYPE'          =>  'Redis',    //session类型
    'SESSION_PERSISTENT'    =>  0,        //是否长连接(对于php来说0和1都一样)
    'SESSION_CACHE_TIME'    =>  60,        //连接超时时间(秒)
    'SESSION_EXPIRE'        =>  0,        //session有效期(单位:秒) 0表示永久缓存
    'SESSION_PREFIX'        =>  'Zhihui:Session:',        //session前缀
    'SESSION_REDIS_HOST'    =>  '127.0.0.1', //分布式Redis,默认第一个为主服务器
    'SESSION_REDIS_PORT'    =>  '6379',           //端口,如果相同只填一个,用英文逗号分隔
    'SESSION_REDIS_AUTH'    =>  '',    //Redis auth认证(密钥中不能有逗号),如果相同只填一个,用英文逗号分隔

];