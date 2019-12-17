<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:09
 */
namespace app\admin\controller;

use think\Controller;

class Role extends Controller
{
    //声明一下控制器的前置方法
    protected $beforeActionList = [
        //在调用del之前调用del_role_auth方法
        'del_role_auth' => ['only' => 'del']
    ];

    public function lst(){
        $data = model('Role')->sel();
        return view('',['data'=>$data]);
    }

    public function add(){
        if(request()->isPost()){
            try{
                $res = model('Role')->addData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('添加成功','lst');
        }
        //将所有的权限都查询出来
        $auth_data = db('auth')->order('ids_path')->select();
        return view('',['auth_data'=>$auth_data]);
    }

    public function edit(){
        if(request()->isPost()){
            try{
                $res = model('Role')->editData();
                //当更新没有成功但是没有抛异常，咱把更新失败这几个字抛出
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }

            $this->success('更新成功','lst');
        }
        $id = input('param.id');
        //将所有的权限都查询出来
        $auth_data = db('auth')->order('ids_path')->select();

        //通过id查询数据   获得角色的信息和权限对应的权限信息
        $data = model('Role')
            ->field('a.*,group_concat(b.auth_id) auth_ids')
            ->alias('a')
            ->join('role_auth b' ,'a.id = b.Role_id')
            ->find($id);
        //解释strpos
//        $str1 = ','.'201,102,103'.',';
//        $str = ','.'102'.',';
//
//        $str1 = ','.$data.auth_ids.',';
//        $str = ','.$v.id.',';
//        $res = strpos(','.$data.auth_ids.',',','.$v.id.',');
//        dump($res);

        return view('',['data'=>$data,'auth_data'=>$auth_data]);
    }

    public function del_role_auth(){
        $id = input('param.id');
        $res = db('role_auth')->where('role_id','=',$id)->delete();
        if(!$res){
            $arr = [
                'status' => 2,
                'msg' => '删除失败！'
            ];
            echo json_encode($arr);
            exit;
        }
    }

    public function del(){

        $id = input('param.id');
        $res = model("Role")->where('id','=',$id)->delete();
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

        echo json_encode($arr);
        exit;
    }

    /**
     * 停用
     */
    public function stop(){
        $id = input('post.id');
        $res = model('Role')->save(['status'=>2],['id'=>$id]);
        if($res){
            $arr = [
                'status' => 1,
                'msg' => '已停用！',
            ];
        }else{
            $arr = [
                'status' => 2,
                'msg' => '操作失败！',
            ];
        }
        echo json_encode($arr);
        exit;
    }

    /**
     * 启用
     */
    public function start(){
        $id = input('post.id');
        $res = model('Role')->save(['status'=>1],['id'=>$id]);
        if($res){
            $arr = [
                'status' => 1,
                'msg' => '已启用！',
            ];
        }else{
            $arr = [
                'status' => 2,
                'msg' => '操作失败！',
            ];
        }
        echo json_encode($arr);
        exit;
    }

}