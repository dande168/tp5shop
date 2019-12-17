<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28 0028
 * Time: 10:45
 */

namespace app\index\validate;


use think\Validate;

class Order extends Validate
{
    protected $rule = [
        'shr_name' => 'require',
        'shr_address' => 'require',
        'shr_tel' => 'require',
        'express' => 'require',
        'pay_method' => 'require',
    ];

    protected $message = [
        'user_name.require' => '收货人名称不能为空',
        'shr_address.require' => '收货人地址不能为空',
        'shr_tel.require' => '收货人电话不能为空',
        'express.require' => '快递不能为空',
        'pay_method.require' => '支付方式不能为空',
    ];
}