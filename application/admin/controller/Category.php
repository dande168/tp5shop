<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/11 0011
 * Time: 10:07
 */

namespace app\admin\controller;


class Category extends Base
{
    public function lst(){
        $data = model('Category')->sel();
        return view('',['data'=>$data]);
    }

    public function add(){
        if(request()->isPost()){
            try{
                $res = model('Category')->addData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('添加成功','lst');
        }
        //查询所有的上级分类
        $data = model('Category')->sel();
        return view('',['data'=>$data]);
    }

    public function edit(){
        if(request()->isPost()){
            try{
                $res = model('Category')->editData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('编辑成功','lst');
        }
        //查询所有的上级分类
        $data = model('Category')->sel();

        //把要修改的id对应的数据都查出来
        $id = input('param.id');
        $dt = model('Category')->find($id);
        return view('',['data'=>$data,'dt'=>$dt]);
    }

    public function del(){
        $id = input('param.id');

        $rs = model('Category')->where('pid','=',$id)->find();
        if($rs){
            //当有子分类，不能删除
            $arr = [
                'status' => 2,
                'msg' => '有子分类,不能删除！'
            ];
        }else{
            //如果没有子分类，执行删除语句
            $res = model("Category")->where('id','=',$id)->delete();
            if($res){
                $arr = [
                    'status' => 1,
                    'msg' => '删除成功！'
                ];
            }else{
                $arr = [
                    'status' => 2,
                    'msg' => '删除失败！'
                ];
            }
        }

        echo json_encode($arr);
        exit;
    }
}