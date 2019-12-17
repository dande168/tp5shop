<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/11 0011
 * Time: 10:21
 */

namespace app\common\model;

use app\admin\validate\Goods as GoodsValidate;

class Goods extends Base
{

    protected $autoWriteTimestamp = true;

    public function sel(){
        $where = [];
        /********************时间查询(没有秒)*************************/
        //先获取当前提交的时间数据
        $s_time = input('param.start_time');
        $e_time = input('param.end_time');

        //将对应的字符串截取年月日,即2017-12-03,然后拼接上时分秒
        $_start_time = substr($s_time,0,10).' 00:00:00';
        $_end_time = substr($e_time,0,10).' 23:59:59';
        //将拼接好的时分秒进行时间戳转化
        $start_time = strtotime($_start_time);
        $end_time = strtotime($_end_time);

        if(!empty($s_time) && !empty($e_time)){
            //若填写了开始时间和结束时间，将时间用between对where变量进行赋值
            $where['update_time'] = ['between',[$start_time,$end_time]];
        }else if(!empty($s_time)){
            //若填写了开始时间，而没有填写结束时间，则只将开始时间写入where
            $where['update_time'] = ['>=',$start_time];
        }else if(!empty($e_time)){
            //若填写了结束时间，而没有填写开始时间，则只将结束时间写入where
            $where['update_time'] = ['<=',$end_time];
        }

        /**************管理员名称*******************/
        $goods_name = input('param.goods_name');
        if(!empty($goods_name)){
            $where['goods_name'] = ['=',$goods_name];
        }

        $data = $this->alias('a')
            ->field('a.*,b.cate_name,c.brand_name')
            ->join('category b','a.cate_id = b.id','LEFT')
            ->join('brand c','a.brand_id = c.id','LEFT')
            ->where($where)
            ->order('orders desc')
            ->paginate(5);


        return $data;
    }

    public function addData(){
        $dt = input('post.');

        //将ueditor传过来的值进行转化
        $dt['descr'] = $dt['editorValue'];

        //参数验证
        $validate = new GoodsValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }
        //添加到数据库
        $res = $this->allowField(true)->save($dt);

        if(!$res){
            return '添加失败';
        }

        //将上传成功的缓存图片路径清除
        cache('pics_url',null);

        return true;
    }

    public function editData(){
        $dt = input('post.');
        $id = input('post.id');

        //将ueditor传过来的值进行转化
        $dt['descr'] = $dt['editorValue'];

        /*************先删除图片，再更新数据，可能会出现更新失败，但是图片被删除的情况****************/
        //先查询是否上传了图片
//        if(!empty($dt['big_pic'])){
//            //如果上传了图片，查询出老图片的路径，删除
//            $info = $this->find($id);
//            @unlink('.'.$info['big_pic']);
//            @unlink('.'.$info['small_pic']);
//        }


        //参数验证
        $validate = new GoodsValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }

        //如果上传的图片路径为空，将对应字段删除
        if(empty($dt['big_pic'])) {
            unset($dt['big_pic']);
            unset($dt['small_pic']);
        }

        //编辑到数据库
        $res = $this->allowField(true)->save($dt,['id'=> $id]);
        if(!$res){
            return '编辑失败';
        }

        //将上传图片路径的缓存清除
        cache('pics_url',null);

        //数据更新完成后，当上传了新图片时，删除老的图片
        if(!empty($dt['big_pic'])) {
            @unlink('.' . $dt['old_big_pic']);
            @unlink('.' . $dt['old_small_pic']);
        }
        return true;
    }

    /**************前台方法*****************/
    /**
     * //获取推荐商品
    $goods_tj_data = model('Goods')
    ->alias('a')
    ->field('a.*,b.brand_name')
    ->join('brand b','a.brand_id = b.id','LEFT')
    ->order('a.orders desc')
    ->where('is_tj = 1')
    ->limit(4)
    ->select();
    //获取热卖商品
    $goods_hot_data = model('Goods')->alias('a')
    ->field('a.*,b.brand_name')
    ->join('brand b','a.brand_id = b.id','LEFT')
    ->order('a.orders desc')
    ->where('is_hot = 1')
    ->limit(4)
    ->select();
    //获取最新商品
    $goods_new_data = model('Goods')->alias('a')
    ->field('a.*,b.brand_name')
    ->join('brand b','a.brand_id = b.id','LEFT')
    ->order('a.orders desc')
    ->where('is_new = 1')
    ->select();
    //获取所有的商品
    $goods_data = model('Goods')->alias('a')
    ->field('a.*,b.brand_name')
    ->join('brand b','a.brand_id = b.id','LEFT')
    ->order('a.orders desc')
    ->limit(6)
    ->select();
     */
    /**
     * 推荐
     * @return false|mixed|\PDOStatement|string|\think\Collection
     */
    public function is_tj($search_id = '',$flag = 1){

        //当不填还是原来的条件
        $where = 'is_tj = 1';

        if(!empty($search_id)){
            //当为1的时候，查询分类
            if($flag == 1){
                $where .= " and a.cate_id in ($search_id)";
                //当为2的时候，查询品牌
            }else if($flag == 2){
                $where .= " and brand_id in ($search_id)";
                //当为3的时候，查询商品
            }else{
                $where .= " and a.id in ($search_id)";
            }

        }
        $goods_tj_data = $this
            ->alias('a')
            ->field('a.*,b.brand_name')
            ->join('brand b','a.brand_id = b.id','LEFT')
            ->order('a.orders desc')
            ->where($where)
            ->limit(4)
            ->select();

        return $goods_tj_data;
    }
    //获取热卖商品
    public function is_hot($search_id = '',$flag = 1){
        //当不填还是原来的条件
        $where = 'is_hot = 1';
        if(!empty($search_id)){
            //当为1的时候，查询分类
            if($flag == 1){
                $where .= " and a.cate_id in ($search_id)";
                //当为2的时候，查询品牌
            }else if($flag == 2){
                $where .= " and brand_id in ($search_id)";
                //当为3的时候，查询商品
            }else{
                $where .= " and a.id in ($search_id)";
            }

        }
        $goods_hot_data = $this->alias('a')
            ->field('a.*,b.brand_name')
            ->join('brand b','a.brand_id = b.id','LEFT')
            ->order('a.orders desc')
            ->where($where)
            ->limit(4)
            ->select();
        return $goods_hot_data;
    }
    //获取最新商品
    public function is_new($search_id = '',$flag = 1){
        //当不填还是原来的条件
        $where = 'is_new = 1';
        if(!empty($search_id)){
            //当为1的时候，查询分类
            if($flag == 1){
                $where .= " and a.cate_id in ($search_id)";
                //当为2的时候，查询品牌
            }else if($flag == 2){
                $where .= " and brand_id in ($search_id)";
                //当为3的时候，查询商品
            }else{
                $where .= " and a.id in ($search_id)";
            }

        }
        //获取最新商品
        $goods_new_data = $this->alias('a')
            ->field('a.*,b.brand_name')
            ->join('brand b','a.brand_id = b.id','LEFT')
            ->order('a.orders desc')
            ->where($where)
            ->limit(4)
            ->select();
        return $goods_new_data;
    }

    //获取促销商品
    public function is_cx($search_id = '',$flag = 1){
        //当不填还是原来的条件
        $where = 'is_cx = 1';
        if(!empty($search_id)){
            //当为1的时候，查询分类
            if($flag == 1){
                $where .= " and a.cate_id in ($search_id)";
                //当为2的时候，查询品牌
            }else if($flag == 2){
                $where .= " and brand_id in ($search_id)";
                //当为3的时候，查询商品
            }else{
                $where .= " and a.id in ($search_id)";
            }

        }
        //获取最新商品
        $goods_cx_data = $this->alias('a')
            ->field('a.*,b.brand_name')
            ->join('brand b','a.brand_id = b.id','LEFT')
            ->order('a.orders desc')
            ->where($where)
            ->select();
        return $goods_cx_data;
    }
    //获取所有的商品
    public function goods_data($search_id = '',$flag = 1){
        //当不填还是原来的条件
        $where = '1 = 1';
        if(!empty($search_id)){
            //当为1的时候，查询分类
            if($flag == 1){
                $where .= " and a.cate_id in ($search_id)";
                //当为2的时候，查询品牌
            }else if($flag == 2){
                $where .= " and brand_id in ($search_id)";
                //当为3的时候，查询商品
            }else{
                $where .= " and a.id in ($search_id)";
            }

        }
        $goods_data = $this->alias('a')
            ->field('a.*,b.brand_name')
            ->join('brand b','a.brand_id = b.id','LEFT')
            ->where($where)
            ->order('a.orders desc')
            ->paginate(3);
        return $goods_data;
    }

    public function sel_num($goods_id,$num){
        //先判断库存
        $num_data = $this->field('num')->where('id','=',$goods_id)->find();
        if($num > $num_data['num']){
            return '库存不足';
        }
        return true;
    }

}