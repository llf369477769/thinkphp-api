<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 18:22
 */

namespace Common\Logic;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;


class QrCodeLogic
{

    /**
     * 创建二维码图片
     * @param $param
     * @return string
     */
    public function createQrCode($param, $save_dir = 'Uploads/wxCode/'){
        // Create a basic QR code
        $qrCode = new QrCode($param['url']);
        $qrCode->setSize($param['width']);

        // Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setMargin(10);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
//        $qrCode->setLabel('Scan the code', 16, __DIR__.'/../assets/fonts/noto_sans.otf', LabelAlignment::CENTER);
//        $qrCode->setLogoPath(__DIR__.'/logo.png'); //设置logo
        $qrCode->setLogoWidth(50);
        $qrCode->setRoundBlockSize(true);
        $qrCode->setValidateResult(false);


        // Directly output the QR code
       // header('Content-Type: '.$qrCode->getContentType());
        //echo $qrCode->writeString();

        // Save it to a file
        $dir = iconv("UTF-8", "GBK", $save_dir.$param['width']); //创建文件夹
        if (!is_dir($dir)){
            mkdir($dir,0777,true);
        }

        $filepath = $save_dir.$param['width'].'/'.$param['sn'].'.png';
        $qrCode->writeFile($filepath);

        // Create a response object
       // $response = new QrCodeResponse($qrCode);
        return $filepath;
    }
}