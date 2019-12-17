<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:11
 */
namespace app\admin\validate;


use think\Validate;

class Brand extends Validate
{
    protected $rule = [
        'brand_name' => 'require|unique:brand',
        'orders' => 'require',
    ];

    protected $message = [
        'brand_name.require' => '品牌名称不能为空',
        'brand_name.unique' => '品牌名称已存在',
        'orders.require' => '排序不能为空',
    ];

}