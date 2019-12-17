<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:11
 */
namespace app\admin\validate;


use think\Validate;

class Auth extends Validate
{
    protected $rule = [
        'auth_name' => 'require|unique:auth',
        'pid' => 'require',
        'orders' => 'require',
    ];

    protected $message = [
        'auth_name.require' => '权限名称不能为空',
        'auth_name.unique' => '权限名称已存在',
        'pid.require' => '上级权限不能为空',
        'orders.require' => '排序不能为空',
    ];

}