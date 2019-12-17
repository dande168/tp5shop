<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:11
 */
namespace app\admin\validate;


use think\Validate;

class Role extends Validate
{
    protected $rule = [
        'role_name' => 'require|unique:role',
        'orders' => 'require',
    ];

    protected $message = [
        'role_name.require' => '角色名称不能为空',
        'role_name.unique' => '角色名称已存在',
        'orders.require' => '排序不能为空',
    ];

    protected $scene = [
        'add' => ['role_name','orders'],
        'edit' => ['role_name','orders'],
    ];
}