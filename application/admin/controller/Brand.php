<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8 0008
 * Time: 11:19
 */

namespace app\admin\controller;


class Brand extends Base
{
    public function lst(){
        $data = model('Brand')->sel();
        return view('',['data' => $data]);
    }

    public function add(){
        if(request()->isPost()){
            try{
                $res = model('Brand')->addData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('添加成功','lst');
        }
        return view();
    }

    public function edit(){
        if(request()->isPost()){
            try{
                $res = model('Brand')->editData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('编辑成功','lst');
        }
        $id = input('param.id');
        $data = model('Brand')->find($id);
        return view('',['data' => $data]);
    }

    public function del(){

        $id = input('param.id');

        //现查询对应的数据记录
        $data = model('Brand')->find($id);

        $res = model("Brand")->where('id','=',$id)->delete();
        if($res){
            $arr = [
                'status' => 1,
                'msg' => '删除成功！'
            ];
            //当删除成功后将对应的图片也删除
            @unlink('.'.$data['logo']);
        }else{
            $arr = [
                'status' => 2,
                'msg' => '删除失败！'
            ];
        }

        echo json_encode($arr);
        exit;
    }
}