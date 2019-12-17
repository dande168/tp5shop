<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/20 0020
 * Time: 10:56
 */

namespace app\common\model;

use app\index\validate\User as UserValidate;
use think\captcha\Captcha;
use think\Session;

class User extends Base
{

    public static function init(){
        self::event('before_insert',function ($user){
            //密码加密
            $user['user_pass'] = md5(config('admin_base.md5_prefix').$user['user_pass']);
            //生成邮箱激活码
            $user['email_code'] = md5(config('admin_base.md5_prefix').mt_rand(10000,99999).$_SERVER['REQUEST_TIME_FLOAT']);
        });
    }

    public function addData(){
        $dt = input('post.');

        $capt = new Captcha();
        if(!$capt->check($dt['ca_code'])){
            return '验证码错误';
        }

        //验证数据
        $validate = new UserValidate();
        if(!$validate->scene('regist')->check($dt)){
            return $validate->getError();
        }

        $res = $this->allowField(true)->save($dt);

        if(!$res){
            return '注册失败';
        }
        //调用邮件发送
        $this->send_email($dt['email'],'布塔商城',$this->getAttr('email_code'));

        return true;
    }

    public function send_email($to,$title,$email_code){
        $pre_url = config('index_base.pre_url');
        $content = <<<email
            <p>欢迎注册布塔商城,请点击下面的连接进行激活</p>
            <p><a href="{$pre_url}/index/User/check_email/email_code/{$email_code}">点击激活</a></p>
email;

        sendMail($to,$title,$content);
    }

    public function login(){
        $dt = input('post.');

        $validate = new UserValidate();
        if(!$validate->scene('login')->check($dt)){
            return $validate->getError();
        }

        $res = $this->where('user_name','=',$dt['user_name'])->find();

        if($res){
            if($res['user_pass'] == md5(config('admin_base.md5_prefix').$dt['user_pass'])){

                //将用户的登录信息返给到session
                session('user_name',$dt['user_name']);
                session('user_id',$res['id']);

                //登录成功后，将未登录时添加到购物车中的商品添加到数据库
                $res = model('Cart')->loginAddToCart();

                return true;
            }
            return '密码错误';
        }
        return '用户名不存在';
    }
}