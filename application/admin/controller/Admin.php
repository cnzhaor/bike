<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as adminModel;
use think\Db;

class Admin extends Common
{
    public function lst()
    {
        $adminInfo = adminModel::lst();
        $page = $adminInfo->render();
        $this->assign([
            'adminInfo' => $adminInfo,
            'page' => $page,
        ]);
        return view();
    }
    public function add()
    {
        // 使用model助手函数实例化Admin模型
        $admin = model('admin');
        if(request()->isPost()){
            // 模型对象赋值
            $admin->data(input('post.'));
            if($admin->save()){
                $this->success('用户添加成功！', url('lst'));
            }
            else
                $this->error('用户添加失败！', url('add'));
        }
        else
            return view();
    }
    public function edit($id)
    {
        $admin = new adminModel();
        if(request()->isPost()){
            if ($admin->edit($id))
                $this->success('修改成功！', url('lst'));
            else
                $this->error('修改失败'.$admin->getError());
        }
        else{
            if ($adminInfo = $admin->find($id)){
                $this->assign([
                    'adminInfo' => $adminInfo
                ]);
                return view();
            }
            else{
                $this->error('非法操作！');
            }
        }
    }
    public function delete($id)
    {
        $admin = new adminModel();
        if($admin->del($id))
            $this->success('删除成功!', url('lst'));
        else
            $this->error('删除失败！'.$admin->getError());
    }
    public function logout()
    {
        session(null);
        $this->success('再见！', url('login/index'));
    }
}
