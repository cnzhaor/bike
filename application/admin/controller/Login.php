<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
    public function index()
    {
        if(input('post.')){
            $user = input('post.');
            $adminModel = new Admin();
            $ret = $adminModel->login($user);
            if($ret)
                $this->success('欢迎回来！',url('index/index'));
            else
                $this->error($adminModel->getError());
        }
        else
            return view();
    }
}
