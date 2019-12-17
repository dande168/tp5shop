<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5 0005
 * Time: 17:11
 */
namespace app\admin\validate;


use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'cate_id' => 'require',
        'brand_id' => 'require',
        'goods_name' => 'require',
        'title' => 'require',
        'introduce' => 'require',
        'num' => 'require',
        'price' => 'require',
        'pic' => 'file',
        'is_cx' => 'require',
        'is_new' => 'require',
        'is_tj' => 'require',
        'is_hot' => 'require',
        'orders' => 'require',
        'editorValue' => 'require',
    ];

    protected $message = [
        'cate_id.require' => '商品分类不能为空',
        'brand_id.require' => '品牌不能为空',
        'goods_name.require' => '商品名称不能为空',
        'title.require' => '商品标题不能为空',
        'introduce.require' => '商品摘要不能为空',
        'num.require' => '库存不能为空',
        'price.require' => '价格不能为空',
        'pic.file' => '请上传图片',
        'is_cx.require' => '是否促销不能为空',
        'is_new.require' => '是否新品不能为空',
        'is_tj.require' => '是否推荐不能为空',
        'is_hot.require' => '是否热卖不能为空',
        'orders.require' => '排序不能为空',
        'editorValue.require' => '商品详情不能为空',
    ];

}