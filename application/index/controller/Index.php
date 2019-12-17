<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        //获取分类列表
        $c_data = db('category')->select();
        $cate_data = model('Category')->getChilds($c_data);
//        dump($cate_data);
//        exit;

        //获取推荐商品
        $goods_tj_data = model('Goods')->is_tj();
        //获取热卖商品
        $goods_hot_data = model('Goods')->is_hot();
        //获取最新商品
        $goods_new_data = model('Goods')->is_new();
        //获取所有的商品
        $goods_data = model('Goods')->goods_data();

        //查询所有的品牌
        $brand_data = model('Brand')->order('orders desc')->select();
        $arr = [
          'brand_data' => $brand_data,
          'goods_new_data' => $goods_new_data,
          'goods_hot_data' => $goods_hot_data,
          'goods_tj_data' => $goods_tj_data,
          'goods_data' => $goods_data,
          'cate_data' => $cate_data,
        ];
        return view('',['data'=>$arr]);
    }
}
