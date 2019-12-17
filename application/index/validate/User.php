<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:11
 */
namespace app\index\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'user_name' => 'require|length:3,10|unique:user',
        'user_pass' => 'require|length:3,10',
        're_user_pass' => 'require|length:3,10|confirm:user_pass',
        'email' => 'require|email',
    ];

    protected $message = [
        'user_name.require' => '用户名不能为空',
        'user_name.length' => '用户名长度在3-10之间',
        'user_name.unique' => '用户名已存在',
        'user_pass.require' => '密码不能为空',
        'user_pass.length' => '密码长度在3-10之间',
        're_user_pass.require' => '确认密码不能为空',
        're_user_pass.length' => '确认密码长度在3-10之间',
        're_user_pass.confirm' => '两次密码不一致',
        'email.require' => '邮箱不能为空',
        'email.email' => '必须是邮箱格式',
    ];

    protected $scene = [
        'login' => ['user_name.require','user_name.length','user_pass'],
        'regist' => ['user_name','user_pass','re_user_pass','email'],
    ];
}