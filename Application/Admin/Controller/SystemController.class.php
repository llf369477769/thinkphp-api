<?php
namespace Admin\Controller;

class SystemController extends BaseController
{
    public function index()
    {
        $config = M('api_config')->find();
        $this->assign('config',$config);
        $this->display();
    }

    public function save()
    {
        $config = I('post.','');
        $config['site_url'] = trim($config['site_url']);
        if (empty($config['id'])){
            $res = M('api_config')->add($config);
        } else {
            $res = M('api_config')->save($config);
        }

        if ($res === false){
            $this->ajaxError('保存失败');
        }
        $this->ajaxSuccess('保存成功');
    }

}