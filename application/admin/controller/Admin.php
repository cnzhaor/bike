<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as adminModel;

class Admin extends Controller
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
    public function edit()
    {
        return view();
    }
}
