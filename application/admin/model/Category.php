<?php

namespace app\admin\model;

use think\Model;

class Category extends Model
{
    public function getAll()
    {
        $cats = self::all(function($query){
            $query->order('sort', 'asc');
        });
        return $this->getTree($cats);
    }

    public function getTree($cats, $pid=0, $level=0)
    {
        //静态属性的基本作用， 就是与普通的属性不同的是， 静态属性会记住之前的值
        static $ret =[];
        foreach ($cats as $cat) {
            if($cat['pid'] == $pid){
                $cat['level'] = $level;
                $ret[] = $cat;
                $this->getTree($cats, $cat['id'], $level+1);
            }
        }
        return $ret;
    }
}
