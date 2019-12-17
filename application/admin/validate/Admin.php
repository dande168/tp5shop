<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:11
 */
namespace app\admin\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'admin_user' => 'require|length:3,10|unique:admin',
        'admin_pass' => 'require|length:3,10',
        're_admin_pass' => 'require|length:3,10|confirm:admin_pass',
        'status' => 'require|in:1,2',
    ];

    protected $message = [
        'admin_user.require' => '管理员名称不能为空',
        'admin_user.length' => '管理员名称长度在3-10之间',
        'admin_user.unique' => '管理员名称已存在',
        'admin_pass.require' => '密码不能为空',
        'admin_pass.length' => '密码长度在3-10之间',
        're_admin_pass.require' => '确认密码不能为空',
        're_admin_pass.length' => '确认密码长度在3-10之间',
        're_admin_pass.confirm' => '两次密码不一致',
        'status.require' => '状态不能为空',
        'status.in' => '状态必修是1或者2',
    ];

    protected $scene = [
        'add' => ['admin_user','admin_pass','re_admin_pass','status'],
        'edit' => ['admin_user','status'],
    ];
}