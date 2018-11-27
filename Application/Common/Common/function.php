<?php

/**
 * 获取HTTP全部头信息
 */
if (!function_exists('apache_request_headers')) {
	function apache_request_headers(){
		$arh = array();
		$rx_http = '/\AHTTP_/';
		foreach ($_SERVER as $key => $val) {
			if (preg_match($rx_http, $key)) {
				$arh_key = preg_replace($rx_http, '', $key);
				$rx_matches = explode('_', $arh_key);
				if (count($rx_matches) > 0 and strlen($arh_key) > 2) {
					foreach ($rx_matches as $ak_key => $ak_val)
						$rx_matches[$ak_key] = ucfirst($ak_val);
					$arh_key = implode('-', $rx_matches);
				}
				$arh[$arh_key] = $val;
			}
		}

		return $arh;
	}
}

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @param  string $auth_key 要加密的字符串
 * @return string
 * @author jry <598821125@qq.com>
 */
function user_md5($str, $auth_key = ''){
    if(!$auth_key){
        $auth_key = C('AUTH_KEY');
    }
    return '' === $str ? '' : md5(sha1($str) . $auth_key);
}

/**
 * @param     $url
 * @param int $timeOut
 * @return bool|mixed
 */
if (!function_exists('curlGet')) {
	function curlGet($url, $timeOut = 10){
		$oCurl = curl_init();
		if (stripos($url, "https://") !== false) {
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_TIMEOUT, $timeOut);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if (intval($aStatus["http_code"]) == 200) {
			return $sContent;
		} else {
			return false;
		}
	}
}


/**
 * 返回基本地址
 * @author huangqisheng
 * @param string $host
 * @return string
 */
function getBaseUrl($host = 'https') {
    return 'http://'.$_SERVER['HTTP_HOST'];
}

/**
 * 返回静态图片地址
 * @param string $host
 */
function getStaticUrl($url){
    return 'http://'.$_SERVER['HTTP_HOST'].'/'.$url;
}

/**
 * 获取图片地址
 * @author huangqisheng
 * @param $path string 图片路径
 * @param int $type 1 获取原图 2根据尺寸获取缩略图图片地址
 * @param string $width 宽度
 * @param string $height 高度
 * @return string
 */
function getImageUrl($path, $type = 1, $width = '144',$height = '144') {
    if(!$path) return '';
    $baseUrl = getBaseUrl();
    if ($type == 1) {
        return $baseUrl . $path;
    } elseif ($type == 2) {
        $ext = substr(strrchr($path, '.'), 1);
        $baseUrl .= dirname($path); //拼接目录
        $thumbName = basename($path, '.' . substr(strrchr($path, '.'), 1));
        $baseUrl .= '/' . $thumbName;//找到缩略图目录
        $baseUrl .= '/' . $thumbName . '_' . $width . 'X' . $height . '.' . $ext;
    }
    return $baseUrl;
}

/**
 * @param $arr
 * @param $key_name
 * @return array
 * 将数据库中查出的列表以指定的 id 作为数组的键名
 */
function convert_arr_key($arr, $key_name)
{
    $arr2 = array();
    foreach($arr as $key => $val){
        $arr2[$val[$key_name]] = $val;
    }
    return $arr2;
}


/**
 * 生成不重复序号
 * @param $member_id int
 * @return srting
 */
function getCode($member_id,$start = 1,$end = 1) {
    $microtime = microtime();
    $micro = explode(' ', $microtime);
    $micro = $micro[0];
    $micro = explode('.', $micro);
    $micro = $micro[1];
    $time = explode(' ', $microtime);
    $time = date('YmdHis', $time[1]);
    $md5_str = md5($time . $member_id . $micro);
    $mem_str = md5($member_id);
    $key = '0123456789abcdefghijklmnopqrstuvwxyz';
    $res1 = '';
    for ($i = 0; $i < 32; ++$i) {
        $res1 .= strpos($key, $md5_str[$i]);
    }
    $res2 = '';
    for ($i = 0; $i < 4; ++$i) {
        $res2 .= strpos($key, $mem_str[$i]);
    }
    return date('YmdHis', time()) . substr($res1, 0, $start) . substr($res2, 0, $end);
}



/**
 * 生成随机数
 * @param $len 长度
 * @author wangxianlin
 * @param int $type 类型 1 数字 2 字母 3 数字+字母
 * @return string
 */
function getRandCode($len, $type = 1) {
    srand((double)microtime() * 1000000);//create a random number feed.
    $arr = array();
    $number = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
    $_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    if ($type == 1) {
        $arr = array_merge($arr, $number);
    } elseif ($type == 2) {
        $arr = array_merge($arr, $_code);
    } elseif ($type == 3) {
        $arr = array_merge($arr, $number, $_code);
    }
    $arr_len = count($arr);
    $authnum = '';
    for ($i = 0; $i < $len; $i++) {
        $randnum = rand(0, $arr_len - 1); // 10+26;
        $authnum .= $arr[$randnum];
    }
    return $authnum;
}


/**
 * 验证手机号
 * @param string $str 手机号
 * @return bool
 */
function checkMobile($str){
    $pattern = '/^1[34578][0-9]{9}$/';
    if (preg_match($pattern,$str)){
        return true;
    }else{
        return false;
    }
}


/**
 * 功能：生成二维码（与composer引入的包不适用，更改为 endroid/qr-code包）
 * @param string $save_path 图片存储路径
 * @param string $qr_data   手机扫描后要跳转的网址
 * @param string $qr_level  默认纠错比例 分为L、M、Q、H四个等级，H代表最高纠错能力
 * @param string $qr_size   二维码图大小，1－10可选，数字越大图片尺寸越大
 * @param string $save_prefix 图片名称前缀
 */
function createQRcode($save_path,$qr_data='PHP QR Code :)',$qr_level='L',$qr_size=4,$save_prefix='qrcode'){
    if(!isset($save_path)) return '';
    //设置生成png图片的路径
    $PNG_TEMP_DIR = & $save_path;
    //导入二维码核心程序
    vendor('phpqrcode.phpqrcode');  //注意这里的大小写哦，不然会出现找不到类，前面的phpqrcode是文件夹名字，后面是类名
    //检测并创建生成文件夹
    if (!file_exists($PNG_TEMP_DIR)){
        mkdir($PNG_TEMP_DIR,0777,true);
    }
    $filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'L';
    if (isset($qr_level) && in_array($qr_level, array('L','M','Q','H'))){
        $errorCorrectionLevel = & $qr_level;
    }
    $matrixPointSize = 4;
    if (isset($qr_size)){
        $matrixPointSize = & min(max((int)$qr_size, 1), 10);
    }

    $QRcode = \QRcode();
    if (isset($qr_data)) {
        if (trim($qr_data) == ''){
            die('data cannot be empty!');
        }
        //生成文件名 文件路径+图片名字前缀+md5(名称)+.png
        $filename = $PNG_TEMP_DIR.$save_prefix.md5($qr_data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        //开始生成
        $QRcode->png($qr_data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    } else {
        //默认生成
        $QRcode->png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    }

    if(file_exists($PNG_TEMP_DIR.basename($filename)))
        return basename($filename);
    else
        return FALSE;
}




/**
 * 函数说明：合并图片
 * @param $src：原图地址,string型
 * @param $dst：保存图片的地址,string型
 * @param $png：需要合并的png图片地址,string型
 * @param $x：水印x轴坐标
 * @param $y：水印y轴坐标
 */
function dobrush($src, $dst, $png, $x=0, $y=0)
{
    $image = new \Imagick($src);
    if (file_exists($png)) {
        $imagepng = new \Imagick($png);
        $imagepng->setImageFormat("png");
        $image->compositeImage($imagepng, $imagepng->getImageCompose(), $x, $y);
        $imagepng->destroy();
    }
    $result = $image->writeImage($dst);
    $image->destroy();
    return $result;
}


/**
 * 图片转base64输出
 * @param $file 图片文件路径
 * @param int $type 类型，1取图片转码信息  2加上图片前缀信息
 * @return string
 */
function imgToBase64($file, $type=1){
    $base64_file = '';
    if(file_exists($file)){
        $image_info = getimagesize($file);
        $base64_data = base64_encode(file_get_contents($file));
        if($type == 1){
            $base64_file = $base64_data;
        }else{
            $base64_file = 'data:'.$image_info['mime'].';base64,'.$base64_data;
        }
    }
    return $base64_file;
}