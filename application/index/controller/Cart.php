<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26 0026
 * Time: 10:18
 */

namespace app\index\controller;


class Cart
{
    public function addCart(){
        $res = model('Cart')->addToCart();
        if($res === true){
            echo json_encode([
                'status' => 1,
                'msg' => '添加成功',
            ]);
        }else{
            echo json_encode([
                'status' => 2,
                'msg' => '添加失败',
            ]);
        }
    }

    public function cartList(){

        $data = model('Cart')->cartDisplay();


        return view('',['data'=>$data]);
    }

    public function delCart(){
        $res = model('Cart')->delCart();
        if($res){
            echo json_encode([
                'status' => 1,
                'msg' => '删除成功',
            ]);
        }else{
            echo json_encode([
                'status' => 2,
                'msg' => '删除失败',
            ]);
        }
    }

    public function changeNum(){
        $res = model('Cart')->changeNum();
        if($res === true){
            echo json_encode([
                'status' => 1,
                'msg' => '更改成功',
            ]);
        }else{
            echo json_encode([
                'status' => 2,
                'msg' => $res,
            ]);
        }
    }
}