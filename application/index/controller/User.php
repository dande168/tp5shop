<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/20 0020
 * Time: 10:01
 */

namespace app\index\controller;


use think\captcha\Captcha;
use think\Controller;
use think\Session;

class User extends Controller
{
    public function login(){
        if(request()->isPost()){
            try{
                $res = model('User')->login();
                if($res !== true){
                    throw exception($res);
                }
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            //判断session中有没有存储跳转路径，若存在跳转过去
            if(Session::has('redirect_url')){
                return redirect()->restore();
            }
            return redirect('Index/index');;
        }
        return view();
    }

    public function logout(){
        session('user_name',null);
        session('user_id',null);
        return redirect('login');
    }

    public function regist(){
        if(request()->isPost()){
            try{
                $res = model('User')->addData();
                if($res !== true){
                    throw exception($res);
                }
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            return $this->success('注册成功','login');
        }
        return view();
    }

    /**
     * 生成二维码
     * @return \think\Response
     */
    public function getCaptcha(){
        $ca = new Captcha([
            'fontSize' => 20,
            'imageH'   => 40,
            'imageW'   => 120,
            'length'   => 2,
        ]);
        return $ca->entry();
    }

    public function check_email(){
        $email_code = input('param.email_code');
        $data = db('User')->where('email_code','=',$email_code)->find();
        if($data){
            $res = db('User')->where('id','=',$data['id'])->setField('email_code','');
            if($res){
                return $this->success('激活成功','login');
            }
            return $this->error('激活失败1，请联系管理员');
        }
        return $this->error('激活失败，请联系管理员');
    }
}