<?php
namespace Upload\Logic;


//上传
class UploadLogic {

    protected $uploadModel;

    public function __construct() {
        $this->uploadModel = D('Upload/UploadImage');
    }

    /**
     * 单图上传
     *
     * @param Array $config
     *            图片配置
     * @param $file 上传图片的$_FILES[name]
     */
    public function oneImage($config = array(), $file = '', $arr = array()) {
        return $this->uploadModel->uploadOne($config, $file, $arr);
    }

    /**
     * 多图上传
     */
    public function manyImage($config = array(), $arr = array()) {
        return $this->uploadModel->uploadMany($config, $arr);
    }

    /**
     * base64图片上传
     * @param  $baseData base数据
     * @param  $ext 文件扩展名
     * @param  $config 自定义配置
     * @param  $arr 用户信息
     */
    public function base64Upload($baseData, $ext = 'png', $config = array(), $arr = array()) {
        return $this->uploadModel->doBase64Upload($baseData, $ext, $config, $arr);
    }

}