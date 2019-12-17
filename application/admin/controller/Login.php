<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8 0008
 * Time: 09:43
 */

namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;

class Login extends Controller
{
    /**
     * 登录
     */
    public function login(){
        if(request()->isPost()){
            $admin_user = input('post.admin_user');
            $admin_pass = input('post.admin_pass');
            $admin_cap = input('post.admin_cap');

            //判断用户名
            if(empty($admin_user)){
                $this->error('用户名不能为空');
            }
            //判断密码
            if(empty($admin_pass)){
                $this->error('密码不能为空');
            }

            //判断验证码
            if(empty($admin_cap)){
                $this->error('验证码不能为空');
            }

            //检查验证码
            $captcha = new Captcha();
            if(!$captcha->check($admin_cap)){
                $this->error('验证码错误');
            }

            //判断用户名
            $data = model('Admin')
                ->where('admin_user','=',$admin_user)
                ->where('status','=','1')
                ->find();
            if(!empty($data)){
                if($data['admin_pass'] == md5(config('admin_base.md5_prefix').$admin_pass)){

                    //添加登录时间和登录ip
                    $dt['login_time'] = time();
                    $dt['login_ip'] = request()->ip();

                    //将登陆时间和ip放入数据库    isAutoWriteTimestamp(false) 更新的时候不自动更新update_time 字段
                    $res = db('admin')->where('admin_user','=',$admin_user)->update($dt);
                    //将用户名和ID放入session
                    session('ad_user',$admin_user);
                    session('ad_id',$data['id']);

                    $this->success('登录成功','Admin/lst');
                }
                $this->error('密码错误');
            }
            $this->error('用户名不存在或被禁用');
        }
        return view();
    }

    /**
     * 退出登录
     */
    public function logout(){
        //将session中的对应的用户信息都清空
        session('ad_user',null);
        session('ad_id',null);

        //都清空后调到登录页面   redirect 重定向   没有提示，直接调到页面
        return redirect('Login/login');
    }

    /**
     * 生成验证码
     */
    public function captcha(){
        //先use 导入一下   创建的时候导入配置即可
        $captcha = new Captcha([
            'fontSize' => 18,
            'useCurve' => false,
            'imageH' => 40,
            'imageW' => 130,
            'length' => 2
        ]);
        //返回图片的路径
        return $captcha->entry();
    }
}