<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Category as CatModel;

class Category extends Common
{
    /**
     * 显示栏目列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $cats = CatModel::all();
        $this->assign('cats', $cats);
        return view();
    }

    /**
     * 显示创建栏目表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $cats = CatModel::all();
        $this->assign('cats', $cats);
        return view();
    }

    /**
     * 保存新建的栏目
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        if($request)
        {
            $catModel = new CatModel();
            $catModel->save($request->param());
        }
    }

    /**
     * 显示指定的栏目
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑栏目表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的栏目
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定栏目
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
