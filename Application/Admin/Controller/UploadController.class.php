<?php
namespace Admin\Controller;
use Think\Upload;

class UploadController extends BaseController
{
    /**
     * 上传图片，可选择是否生成缩略图
     */
    public function index()
    {
        $dir = empty(I('get.dir')) ? 'Uploads/Ad/' : 'Uploads/'.I('get.dir').'/';
        if(!is_dir($dir)){
            mkdir($dir, 0777, true);
        }
        $is_thumb = I('is_thumb'); //是否生成缩略图

        $config = array(
            'maxSize'    =>    2*1024*1024,
            'rootPath'   =>    './',
            'savePath'   =>    $dir,
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );

        $upload = new Upload($config);// 实例化上传类
        $info   =   $upload->upload();

        if ($info){
            $image_path = '';
            $thumb_image = '';
            foreach ($info as $v){
                $image_path = $v['savepath'].$v['savename'];

                if($is_thumb == 1){
                    //生成缩略图
                    $img = $v['savepath'].$v['savename'];//获取文件上传目录
                    $image = new \Think\Image();
                    $image->open($img);  //打开上传图片
                    $thumb_image = $v['savepath'].'thumb_'.$v['savename'];
                    $image->thumb(300, 300,\Think\Image::IMAGE_THUMB_SCALE)->save($thumb_image);//生成等比缩略图
                }
            }

            $res = [
                'type'=>1,
                'msg'=>'success',
                'image_path'=> $image_path,
                'thumb_image' => $thumb_image,
            ];
            $this->ajaxReturn($res,'json');

        } else {
            $res = [
                'type'=>2,
                'msg'=>$upload->getError()
            ];
            $this->ajaxReturn($res,'json');
        }

    }
}