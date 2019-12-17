<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:11
 */
namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'cate_name' => 'require|unique:category',
        'pid' => 'require',
        'orders' => 'require',
    ];

    protected $message = [
        'cate_name.require' => '分类名称不能为空',
        'cate_name.unique' => '分类名称已存在',
        'pid.require' => '上级分类不能为空',
        'orders.require' => '排序不能为空',
    ];

}