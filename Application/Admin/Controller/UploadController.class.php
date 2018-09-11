<?php
namespace Admin\Controller;
use Think\Upload;

class UploadController extends BaseController
{
    public function index()
    {
        $dir = empty(I('get.dir')) ? 'Uploads/Ad/' : 'Uploads/'.I('get.dir').'/';

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
            foreach ($info as $v){
                $image_path = $v['savepath'].$v['savename'];
            }

            $res = [
                'type'=>1,
                'msg'=>'success',
                'image_path'=> $image_path
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