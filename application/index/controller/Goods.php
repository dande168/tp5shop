<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 11:39
 */

namespace app\index\controller;


use think\Controller;

class Goods extends Controller
{
    public function lst(){
        //获取商品id
        $goods_id = input('param.id');
        //查询对应的商品信息
        $goods_data = db('goods')->where('id','=',$goods_id)->find();

        //简单点说就是InnoDB的优点是支持事务，支持非锁定读，行锁设计，以及全文索引，
        //MyISAM的优点是操作速度快，不支持事务以及行锁，是MySQL默认的存储引擎。

        /***************获取猜你喜欢数据**************/
        //从cookie中获取数据
        $res = cookie('re_goods');
        $re_goods_data = [];
        //当cookie不为空时取出对应的数据
        if(!empty($res)){
            $arr0 = explode(',',$res);
            //判断第一个是否为数字，不是去掉第一个的数据 因为第一个的值为assets
           if(!is_numeric($arr0[0])){
               unset($arr0[0]);
           }
            $str0 = implode(',',$arr0);

            //查询对应的数据，并按照$str0对应的顺序排序
            $re_goods_data = db('goods')
                ->alias('a')
                ->field('a.*,b.brand_name')
                ->join('brand b','a.brand_id = b.id','LEFT')
                ->where('a.id','in',$str0)
                ->order("field(a.id,$str0)")
                ->select();
        }

        /******************将商品id放入到cookie中******************/
        //先获取对应的cookie
        $str1 = cookie('re_goods');
        //如果cookie内容为空，设为空数组
        if(empty($str1)){
            $arr1 = [];
        }else{
            //如果不为空，转换成数组
            $arr1 = explode(',',$str1);
        }
        if(empty($arr1)){
            $arr1[] = $goods_id;
        }else{
            //获取对应的数组长度
            $length = count($arr1);
            //去除掉键值为assets和与当前访问商品id相同的数据
            foreach ($arr1 as $k=>$v){
                if(!is_numeric($v) || $v == $goods_id){
                    unset($arr1[$k]);
                }
            }
            if($length >= 5){
                //取出数组的最后一个数据，并将原数组的最后一个数据删除
                array_pop($arr1);
                //在数组的开始放入一个数据
                array_unshift($arr1,$goods_id);
            }else{
                array_unshift($arr1,$goods_id);
            }
        }

        //将商品id放入到cookie中
        $str = implode(',',$arr1);
        cookie('re_goods',$str,7*86400);


        $arr = [
            'goods_data' => $goods_data,
            're_goods_data' => $re_goods_data,
        ];

        return view('',$arr);
    }
}