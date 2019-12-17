<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8 0008
 * Time: 10:56
 */

namespace app\admin\controller;


use think\Controller;

class Base extends Controller
{
    public function _initialize(){
        //在控制器初始化的时候判断是否登录
        $admin_user = session('ad_user');
        $admin_id = session('ad_id');
        if(empty($admin_user)){
            $this->success('请登录','Login/login');
        }

        //当前登录人是admin时,具有所有的权限
        if($admin_user == 'admin'){
            return true;
        }else{
            //获取当前的请求模块名称
            $module = request()->module();
            //获取当前的请求控制器名称
            $controller = request()->controller();
            //获取当前的请求方法名称
            $action = request()->action();

            //获取当前登录人是否有当前访问的页面的权限
            $data = db('role_auth')
                ->field('count(*) count')
                ->alias('a')
                ->join('auth b','a.auth_id = b.id','LEFT')
                ->join('admin_role c','a.role_id = c.role_id','LEFT')
                ->where('b.auth_m','=',$module)
                ->where('b.auth_c','=',$controller)
                ->where('b.auth_f','=',$action)
                ->where('c.admin_id','=',$admin_id)
                ->find();

            if(!$data['count']){
                //如果是ajax请求
                if(request()->isAjax()){
                    echo json_encode([
                        'status' => 2,
                        'msg' => '被禁止访问'
                    ]);
                }else{
                    //如果不是
                    $referer = $_SERVER['HTTP_REFERER'];
                    echo "<center><h1>被禁止访问</h1><h2><a href='{$referer}'>返回上级</a></h2></center>";
                }
                exit;
            }
        }
    }
}