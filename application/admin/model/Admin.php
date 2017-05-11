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
        return db('admin',[],false)->order('id desc')->paginate(2);
    }
}
