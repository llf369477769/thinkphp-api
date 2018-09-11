<?php
/*
 *  参数字典控制器
 *  @author wzj
 *  2018/3/13
 */
namespace Admin\Controller;

class ConfigDictController extends BaseController
{
    /**
     * 参数列表
     * @author wzj
     *  2018/3/13
     */
    public function index()
    {

        $dictModel = D('ApiConfigDict');// 实例化User对象
        $count   = $dictModel->count();
        // 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('header','<span class="rows">共'.$count. '条记录</span>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('first','首页');
        $Page->setConfig('last','末页');
        
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $dictModel->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $type = C('CONFIG_TYPE_LIST');
       
        foreach ($list as $k => $v){
            $list[$k]['type'] = $type[$v['type']];
        }
        
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
    
        $this->display();
    }

    /**
     * 添加参数字典
     * @author wzj
     *  2018/3/13
     */
    public function add()
    {
        if(IS_POST){
            $Dict = D('ApiConfigDict');
            $data = I('post.','');
            $data['create_time'] = time();
            if($Dict->add($data)){
                S('DB_CONFIG_DICT_DATA',null);
                $this->ajaxSuccess('添加成功');
            } else {
                $this->ajaxError('操作失败');
            }

        }

        $this->display();
    }

    /**
     * 编辑参数字典
      *@author wzj
     *  2018/3/13
     */
    public function edit()
    {
        if( IS_GET ) {
            $id = I('get.id');
            if( $id ){
                $detail = D('ApiConfigDict')->where(array('id' => $id))->find();
                $this->assign('detail', $detail);
                $this->display('add');
            }else{
                $this->redirect('add');
            }
        } else if(IS_POST){
            $data = I('post.','');
            $data['update_time'] = time();
            $res = D('ApiConfigDict')->where(array('id' => $data['id']))->save($data);
            if( $res === false ) {
                $this->ajaxError('操作失败');
            } else {
                S('DB_CONFIG_DICT_DATA', null);
                $this->ajaxSuccess('添加成功');
            }

        }

    }

    /**
     * 删除参数字典
     * @author wzj
     *  2018/3/13
     */
    public function del()
    {
        $id = I('post.id');
        $res = D('ApiConfigDict')->where(array('id' => $id))->delete();
        if ($res === false) {
            $this->ajaxError('操作失败');
        } else {
            S('DB_CONFIG_DICT_DATA', null);
            $this->ajaxSuccess('操作成功');
        }
    }

    /**
     * 禁用
     * @author wzj
     * 2018/3/12
     */
    public function close()
    {
        $id = I('post.id');
        $res = D('ApiConfigDict')->where(array('id' => $id))->save(array('status' => 0));
        if ($res === false) {
            $this->ajaxError('操作失败');
        } else {
            S('DB_CONFIG_DICT_DATA', null);
            $this->ajaxSuccess('操作成功');
        }
    }

    /**
     * 启用
     * @author
     * 2018/3/12
     */
    public function open()
    {
        $id = I('post.id');
        $res = D('ApiConfigDict')->where(array('id' => $id))->save(array('status' => 1));
        if ($res === false) {
            $this->ajaxError('操作失败');
        } else {
            S('DB_CONFIG_DICT_DATA', null);
            $this->ajaxSuccess('操作成功');
        }
    }

}