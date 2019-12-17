<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28 0028
 * Time: 09:58
 */

namespace app\common\model;
use app\index\validate\Order as OrderValidate;
use think\Db;

class Order extends Base
{
    protected $autoWriteTimestamp = true;

    public static function init(){
        self::event('before_insert',function ($order){

            //计算购物车中的总金额
            $cart_data = model('Cart')->cartDisplay();
            $order_price = 0;
            foreach ($cart_data as $k=>$v){
                if($v['is_cx'] == 1){
                    $order_price += $v['cx_price']*$v['num'];
                }else{
                    $order_price += $v['price']*$v['num'];
                }
            }
            $order['order_price'] = $order_price;
            $order['user_id'] = session('user_id');
        });
    }

    public function order_detail(){
            //3.判断库存
            $cart_data = model('Cart')->cartDisplay();
            foreach ($cart_data as $k=>$v){
                $goods_data = model('Goods')->field('goods_name,num')->where('id','=',$v['id'])->find();
                if($v['num'] > $goods_data['num']){
                    return $goods_data['goods_name'].'库存不足';
                }
            }
            //4、填写信息、提交订单
            $dt = input('post.');

            //5、判断传过来的参数
            $validate = new OrderValidate();
            if(!$validate->check($dt)){
                return $validate->getError();
            }

            //生成订单号
            $dt['order_no'] = 'bt'.rand(10000,99999).date('YmdHis');

            //开启事务
            Db::startTrans();
            //6、把对应的数据存到数据库
            $res1 = $this->allowField(true)->save($dt);
            $order_id = $this->getLastInsID();

            $flag = true;
            foreach ($cart_data as $k=>$v){
                if($v['is_cx'] == 1)
                    $goods_price = $v['cx_price']*$v['num'];
                else
                    $goods_price = $v['price']*$v['num'];
                //7、将商品数据更新到订单商品表
                $res2 = db('order_goods')
                    ->insert([
                        'user_id' => session('user_id'),
                        'order_id' => $order_id,
                        'order_no' => $dt['order_no'],
                        'goods_id' => $v['id'],
                        'num' => $v['num'],
                        'goods_price' => $goods_price,
                        'create_time' => time(),
                        'update_time' => time(),
                    ]);
                if(!$res2){
                    $flag = false;
                    break;
                }
//                //7、将对应商品的库存减少(将库存减少放到支付成功)
//                $res3 = model('Goods')->where('id','=',$v['id'])->setDec('num',$v['num']);
//                if(!$res3){
//                    $flag = false;
//                    break;
//                }
            }

            if($res1 &&  $flag){
                Db::commit();
                $res4 = db('cart')->query('truncate tp_cart');
                return $order_id;
            }else{
                Db::rollback();
                return '提交失败';
            }

    }
}