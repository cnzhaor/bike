<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
    protected static function init()
    {
        self::event('before_insert', function ($admin) {
            $admin['password'] = md5($admin['password']);
        });
    }
    public static function lst()
    {
        //db助手函数
        return db('admin')->order('id desc')->paginate(2);
    }
    public function edit($id)
    {
        $admin = self::get($id);
        $adminInfo = input('post.');
        if($adminInfo['password'] == '')
            $adminInfo['password'] = $admin['password'];
        else
            $adminInfo['password'] = md5($adminInfo['password']);
        if (false !== $admin->save($adminInfo))
            return true;
        else 
            return false;
    }
    // 删除用户数据
    public function del($id)
    {
        $result = self::destroy($id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    //登录
    public function login($user)
    {
        $userInfor = self::getByUsername($user['username']);
        if ($userInfor){
            if($userInfor['password'] == md5($user['password'])){
                session('username',$user['username']);
                session('id',$userInfor['id']);
                return true;
            }
            else{
                $this->error ='密码错误！';
                return false;
            }
        }
        else{
            $this->error ='用户名不存在！';
            return false;
        }
    }
}
