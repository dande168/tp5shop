<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:09
 */
namespace app\admin\controller;

class Admin extends Base
{
    //声明一下控制器的前置方法
    protected $beforeActionList = [
        //在调用del之前调用del_admin_role方法
        'del_admin_role' => ['only' => 'del']

//        'first', //直接这么写 是在访问当前控制器的所有方法之前都会调用first方法
//        'aa' => ['only'=>'add'],  // only定义只能在哪个方法前执行这个aa方法
//        'bb' => ['except' => 'add'], //  except除了

    ];

//    public function first(){
//        echo 'first';
//        exit;
//    }
//
//    public function aa(){
//        echo 'aa';
//        exit;
//    }
//
//    public function bb(){
//        echo 'bb';
//        exit;
//    }

    public function lst(){
        $data = model('Admin')->sel();
        return view('',['data'=>$data]);
    }

    public function add(){
        if(request()->isPost()){
            try{
                $res = model('Admin')->addData();
                if($res !== true){
                    throw new \Exception($res);
                }
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            $this->success('添加成功','lst');
        }
        //将所有的角色都查询出来
        $role_data = db('role')->select();
        return view('',['role_data'=>$role_data]);
    }

    public function edit(){
        if(request()->isPost()){
            try{
                $res = model('Admin')->editData();
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
        //将所有的角色都查询出来
        $role_data = db('role')->select();

        //通过id查询数据   获得管理员的信息和管理员对应的角色信息
        $data = model('Admin')
            ->field('a.*,group_concat(role_id) role_ids')
            ->alias('a')
            ->join('admin_role b' ,'a.id = b.admin_id')
            ->find($id);
        return view('',['data'=>$data,'role_data'=>$role_data]);
    }

    public function del_admin_role(){
        $id = input('param.id');
        $res = db('admin_role')->where('admin_id','=',$id)->delete();
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
        $res = model("Admin")->where('id','=',$id)->delete();
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
        $res = db('Admin')->where('id','=',$id)->update(['status'=>2]);
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
        $res = db('Admin')->where('id','=',$id)->update(['status'=>1]);
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