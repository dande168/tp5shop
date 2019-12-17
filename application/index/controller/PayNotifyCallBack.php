<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/29 0029
 * Time: 11:38
 */

namespace app\index\controller;
use think\Cache;
use think\Db;
use think\Loader;

Loader::import('Wxpay.lib.WxPay',EXTEND_PATH,'.Api.php');

class PayNotifyCallBack extends \WxPayNotify
{
    /**
     * @param array $data
     * @param string $msg
     * @return bool
     */
    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        if($data['return_code'] == 'SUCCESS' && $data['result_code'] == 'SUCCESS'){
            $order_no = $data['out_trade_no'];
            //减少库存
            Db::startTrans();
            try{
                $r2 = $this->changeNum($order_no);
                if($r2 === true){
                    Db::commit();
                }
            }catch (\Exception $e){
                Db::rollback();
                //更新订单支付状态
                $r3 = db('order')->where('order_no','=',$order_no)->update(['pay_status'=>'支付失败','pay_msg'=>'库存不足']);
            }
            //更新订单支付状态
            $r3 = db('order')->where('order_no','=',$order_no)->update(['pay_status'=>'支付成功']);

            //在缓存中放一个支付开关
            Cache::set($order_no,'已支付');
            return true;
        }else{
            return true;
        }

    }

    public function changeNum($order_no){
        //1.判断库存
        $data = db('order_goods')->where('order_no','=',$order_no)->select();
        foreach ($data as $k=>$v){
            $res3 = model('Goods')->where('id','=',$v['id'])->setDec('num',$v['num']);
        }
        return true;
    }
}