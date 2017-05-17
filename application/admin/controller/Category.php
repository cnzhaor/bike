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
        $catModel = new CatModel();
        $cats = $catModel->getAll();
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
        $catModel = new CatModel();
        $cats = $catModel->getAll();
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
            if($catModel->save($request->param()))
                $this->success('新增成功！',url('index'));
            else
                $this->error('新增失败！');
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
        //获取要修改的对象
        if($data = catModel::get($id)){
            if(request()->isPost()){
                if ($data -> save(input('post.')))
                    $this->success('修改成功！',url('index'));
                else
                    $this->error('修改失败！');
            }
            else{
                $catModel = new CatModel();
                $cats = $catModel->getAll();
                $cat = catModel::getById($id);
                $this->assign([
                    'cats'=> $cats,
                    'cat'=> $cat,
                ]);
                return view();
            }
        }
        else
            $this->error('非法操作！');


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
        $pCat = catModel::getByPid($id);
        if($pCat)
            $this->error('请先删除它的子分类');
        else{
            if(catModel::destroy($id))
                $this->success('删除成功！',url('index'));
            else
                $this->error('删除失败！');
        }
    }
    
    public function sort()
    {
        if(request()->isPost()){
            foreach (input('post.') as $key => $value){
                catModel::update(['id' => $key, 'sort' => $value]);
            }
            $this->redirect('index');
        }
        else
            $this->error('非法操作！',url('index'));
    }
}
