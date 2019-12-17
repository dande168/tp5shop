<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28 0028
 * Time: 09:49
 */

namespace app\index\controller;


use think\Controller;

class Order extends Controller
{
    public function order(){
        /**
         *
        //1、先判断有没有登录
        //2、登录完后跳到订单页面
        //3.判断库存
        //4、填写信息、提交订单
        //5、判断库存
        //6、判断传过来的参数
        //7、把对应的数据存到数据库
        //8、将对应商品的库存减少
         */

        //1、先判断有没有登录
        $user_id = session('user_id');
        $cart_data = model('Cart')->cartDisplay();
        if(empty($cart_data)){
            return  $this->error('購物車不能為空');
        }

        if($user_id){
            if(request()->isPost()){
                $res = '';
                try{
                    $res = model('Order')->order_detail();
                    if(!is_numeric($res)){
                        throw exception($res);
                    }
                }catch (\Exception $e){
                    return  $this->error($e->getMessage());
                }
                return redirect('Pay/pay',['order_id'=>$res]);

            }
        }else{
            //2、登录完后跳到订单页面  在User控制器中
            return redirect('User/login')->remember();
        }
        return view('',['order_goods_data'=>$cart_data]);
    }
}