<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 10:19
 */

namespace app\common\model;


class Cart extends Base
{
    public function addToCart(){
        $user_id = session('user_id');
        $goods_id = input('param.goods_id');
        $num = input('param.num');
        if($user_id){
            //先查询数据库中是否有对应的数据，
            $_res = $this->where('user_id','=',$user_id)->where('goods_id','=',$goods_id)->find();
            if($_res){
                //若存在，则进行数量相加,并进行数据更新
                $num += $_res['num'];
                $res = $this->save([
                    'goods_id' => $goods_id,
                    'num' => $num,
                    'user_id' => $user_id,
                ],['user_id'=>['=',$user_id],'goods_id'=>['=',$goods_id]]);
            }else{
                //若不存在，则直接添加即可
                $res = $this->save([
                    'goods_id' => $goods_id,
                    'num' => $num,
                    'user_id' => $user_id,
                ]);
            }

            if(!$res){
                return false;
            }
            return true;
        }else{
            $coo = cookie('addCartGoods');
            $arr = isset($coo) ? unserialize(cookie('addCartGoods')):[];

            //先判断cookie是否有此商品，有的话与之前个数相加
            if(array_key_exists($goods_id,$arr)){
                $arr[$goods_id] += $num;
            }else{
                //没有的话直接放入
                $arr[$goods_id] = $num;
            }

            cookie('addCartGoods',serialize($arr),7*86400);
            return true;
        }
    }

    public function cartDisplay(){
        $user_id = session('user_id');
        $arr = [];
        if($user_id){
            $arr = $this->where('user_id','=',$user_id)->select()->toArray();
            /**
             * array (size=3)
            0 =>
            array (size=4)
            'id' => int 1
            'goods_id' => int 1
            'num' => int 6
            'user_id' => int 15
            1 =>
            array (size=4)
            'id' => int 2
            'goods_id' => int 2
            'num' => int 1
            'user_id' => int 15
            2 =>
            array (size=4)
            'id' => int 4
            'goods_id' => int 3
            'num' => int 6
            'user_id' => int 15
             */
        }else{
            $coo = cookie('addCartGoods');
            $_arr = isset($coo) ? unserialize(cookie('addCartGoods')):[];

            if(!empty($_arr)){
                foreach ($_arr as $k=>$v){
                    $arr[] = [
                        'id' => 0,
                        'goods_id' => $k,
                        'num' => $v,
                        'user_id' => 0
                    ];
                }
            }
        }

        $data = [];

        //循环展示对应的数据
        foreach ($arr as $k=>$v){
            $res = model('goods')
                ->field('a.id,a.goods_name,a.small_pic,a.is_cx,a.cx_price,a.price,b.brand_name')
                ->alias('a')
                ->join('brand b','a.brand_id = b.id','LEFT')
                ->where('a.id','=',$v['goods_id'])
                ->find();
            $res['num'] = $v['num'];
            $data[] = $res;
        }
        return $data;
    }

    /**
     * 在登录的时候，将没登录添加到购物车中的数据更新到数据库中
     */
    public function loginAddToCart(){
        $user_id = session('user_id');
        //先获取cookie中的信息
        $coo = cookie('addCartGoods');
        $_arr = isset($coo) ? unserialize(cookie('addCartGoods')):[];
        if(!empty($_arr)){
            foreach ($_arr as $k=>$v){
                //查询当前用户之前是否将此商品加入过购物车
                $res1 = $this->where('goods_id','=',$k)->where('user_id','=',$user_id)->find();
                if($res1){
                    //若加入了，进行数量更新
                    $r1 = $this->where('goods_id','=',$k)->where('user_id','=',$user_id)->setInc('num',$v);
                }else{
                    //没加入，进行数据新增
                    $r1 = $this->save([
                        'goods_id' => $k,
                        'num' => $v,
                        'user_id' => $user_id
                    ]);
                }
            }
        }
    }

    public function delCart(){
        $user_id = session('user_id');
        $goods_id = input('post.goods_id');
        if($user_id){
            $res = $this->where('goods_id','=',$goods_id)->where('user_id','=',$user_id)->delete();
            if(!$res){
                return false;
            }
        }else{
            //先获取cookie中的信息(包含全部的商品)
            $coo = cookie('addCartGoods');
            $_arr = isset($coo) ? unserialize(cookie('addCartGoods')):[];
            if(array_key_exists($goods_id,$_arr)){
                unset($_arr[$goods_id]);
            }

            //清空cookie信息
            cookie('addCartGoods','',-1);
            //将处理后的数组放入cookie
            cookie('addCartGoods',serialize($_arr),7*86400);
        }
        return true;
    }

    public function changeNum(){
        $user_id = session('user_id');
        $goods_id = input('post.goods_id');
        $num = input('post.num');

        //判断库存
        $rs = model('Goods')->sel_num($goods_id,$num);
        if($rs !== true){
            return $rs;
        }

        if($user_id){
            $res = $this->save(['num'=>$num],['goods_id'=>['=',$goods_id],'user_id'=>['=',$user_id]]);
            if(!$res){
                return '添加失败';
            }
        }else{
            //先获取cookie中的信息(包含全部的商品)
            $coo = cookie('addCartGoods');
            $_arr = isset($coo) ? unserialize(cookie('addCartGoods')):[];
            if(array_key_exists($goods_id,$_arr)){
                $_arr[$goods_id] = $num;
            }

            //清空cookie信息
            cookie('addCartGoods','',-1);
            //将处理后的数组放入cookie
            cookie('addCartGoods',serialize($_arr),7*86400);
        }
        return true;
    }
}