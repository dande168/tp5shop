<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/20 0020
 * Time: 10:01
 */

namespace app\index\controller;


use think\captcha\Captcha;
use think\Controller;

class GoodsList extends Controller
{
    public function lst(){

        //当点击搜索商品时
        $search = input('param.search');

        $search_id = '';
        //为了区分查询的条件是分类、品牌还是商品  1：分类id 2：品牌id 3:商品id
        $flag = 1;
        if(empty($search)){
            //当为空，即点击分类进入
            $search_id = input('param.cate_id');
        }else{
            //当不为空，即通过搜索进入

            //1、先判断是不是分类
            $cate_res = db('category')->where('cate_name','=',$search)->find();
            if(!empty($cate_res)){
                //若果是分类，取出分类id
                $search_id = $cate_res['id'];
            }else{
                //如果不是分类
                //2、判断是不是品牌
                $brand_res = db('brand')->where('brand_name','=',$search)->find();
                if(!empty($brand_res)){
                    //如果是品牌
                    $search_id = $brand_res['id'];
                    $flag = 2;
                }else{
                    //如果不是品牌
                    $goods_res = db('goods')
                        ->field('group_concat(id) goods_ids')
                        ->where('goods_name','like',"%$search%")->find();

                    $search_id = $goods_res['goods_ids'];
                    $flag = 3;
                }
            }
        }

        //获取特价商品
        $cx_data = model('Goods')->is_cx($search_id,$flag);
        //获取推荐商品
        $tj_data = model('Goods')->is_tj($search_id,$flag);
        //获取新品
        $new_data = model('Goods')->is_new($search_id,$flag);
        //获取所有商品
        $goods_data = model('Goods')->goods_data($search_id,$flag);

        //给下面的两个查询语句定义条件
        $where = '';
        if(!empty($search_id)){
            //当为1的时候，查询分类
            if($flag == 1){
                $where .= " a.cate_id in ($search_id)";
                //当为2的时候，查询品牌
            }else if($flag == 2){
                $where .= " brand_id in ($search_id)";
                //当为3的时候，查询商品
            }else{
                $where .= " a.id in ($search_id)";
            }

        }
        //获取对应品牌
        $brand_data = db('goods')->alias('a')
                    ->field('distinct b.id,b.brand_name,count(b.id) num')
                    ->join('brand b','a.brand_id = b.id','LEFT')
                    ->where($where)
                    ->group('b.id,b.brand_name')
                    ->select();
        //获取对应价格
        $price_data = db('goods')->alias('a')
                    ->field('min(price) min_price,max(price) max_price')
                    ->where($where)
                    ->find();
        $data = [
            'cx_data' => $cx_data,
            'tj_data' => $tj_data,
            'new_data' => $new_data,
            'goods_data' => $goods_data,
            'brand_data' => $brand_data,
            'price_data' => $price_data,
        ];
        return view('',$data);
    }
}