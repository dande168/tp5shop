<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28 0028
 * Time: 11:32
 */

namespace app\index\controller;
use think\Cache;
use think\Controller;
use think\Loader;

Loader::import('Wxpay.lib.WxPay',EXTEND_PATH,'.Api.php');
Loader::import('Wxpay.phpqrcode.phpqrcode',EXTEND_PATH,'.php');

class Pay extends Controller
{
    private $out_trade_no;
    private $total_fee;
    private $product_id;

    public function pay(){


        $user_id = session('user_id');
        $order_id = input('param.order_id');
        $order = db('order')->where('id','=',$order_id)->find();
        if($user_id){
            if($order){
                $this->out_trade_no = $order['order_no'];
                $this->total_fee = $order['order_price'];
                $order_goods = db('order_goods')
                    ->field('group_concat(goods_id) goods_ids')
                    ->where('order_id','=',$order_id)
                    ->where('user_id','=',$user_id)
                    ->find();
                $this->product_id = $order_goods['goods_ids'];

            $url = $this->WxPaysetAndSend();
            return view('',['url'=>$url,'order_no'=>$this->out_trade_no]);
            }
            return $this->error('订单不存在');
        }else{
            return redirect('User/login');
        }

    }

    /**
     * 微信扫码支付的数据设置和发送
     * @return mixed
     */
    public function WxPaysetAndSend(){
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("布塔商城");   //商品简单描述
        $input->SetAttach("测试");   //附加数据，在查询API和支付通知中原样返回
        $input->SetOut_trade_no($this->out_trade_no);    //商户系统内部订单号，要求32个字符内，只能是数字、大小写字母_-|*@ ，且在同一个商户号下唯一
        $input->SetTotal_fee("1");   //订单总金额，单位为分
        $input->SetTime_start(date("YmdHis"));   //订单生成时间，格式为yyyyMMddHHmmss，如2009年12月25日9点10分10秒表示为20091225091010
        $input->SetTime_expire(date("YmdHis", time() + 600)); //订单失效时间，格式为yyyyMMddHHmmss，如2009年12月27日9点10分10秒表示为20091227091010
        $input->SetGoods_tag("test");  //订单优惠标记，使用代金券或立减优惠功能时需要的参数
        //异步接收微信支付结果通知的回调地址，通知url必须为外网可访问的url，不能携带参数。
        //回调地址次数： 30s ,30s ，60s
        $input->SetNotify_url("http://xwh.s1.natapp.cc/project/tp5Shop/public/index.php/index/Pay/notify");
        $input->SetTrade_type("NATIVE");   //交易类型 取值如下：JSAPI，NATIVE，APP等
        $input->SetProduct_id($this->product_id);  //trade_type=NATIVE时（即扫码支付），此参数必传。此参数为二维码中包含的商品ID，商户自行定义
        $result = $this->GetPayUrl($input);
        $url2 = $result["code_url"];
        return $url2;
    }

    /**
     *
     * 生成直接支付url，支付url有效期为2小时,模式二
     * @param UnifiedOrderInput $input
     */
    public function GetPayUrl($input)
    {
        if($input->GetTrade_type() == "NATIVE")
        {
            $result = \WxPayApi::unifiedOrder($input);
            return $result;
        }
    }

    /**
     * 获取扫码支付的二维码
     */
    public function getQrcode(){
        $url = urldecode(input('param.data'));
        \QRcode::png($url);
    }

    public function notify(){
        file_put_contents('./1.txt','调用我这个方法了');
        $pay_notify = new PayNotifyCallBack();
        $pay_notify->Handle(false);
        file_put_contents('./2.txt','调用完成');
    }

    public function getPayResult(){
        $order_no = input('post.order_no');
        $c = Cache::get($order_no);
        if('已支付' == $c){
            echo json_encode(['status'=>'已支付']);
            exit;
        }else{
            echo json_encode(['status'=>2]);
            exit;
        }
    }

    public function pay_success(){
        cache($this->out_trade_no,null);
        return view();
    }
}