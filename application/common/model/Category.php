<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/11 0011
 * Time: 10:21
 */

namespace app\common\model;

use \app\admin\validate\Category as CategoryValidate;

class Category extends Base
{

    protected $autoWriteTimestamp = true;

    public function sel(){
        //查询数据并按照orders降序排列
        $_data = $this->order('orders desc')->select();
        //对数据进行处理，主要用来展示数据
        $data = $this->order_data($_data);
        return $data;
    }

    public function addData(){
        $dt = input('post.');

        //参数验证
        $validate = new CategoryValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }

        //添加到数据库
        $res = $this->save($dt);
        if(!$res){
            return '添加失败';
        }
        return true;
    }

    public function editData(){
        $dt = input('post.');
        $id = input('post.id');

        //参数验证
        $validate = new CategoryValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }

        //编辑到数据库
        $res = $this->save($dt,['id'=> $id]);
        if(!$res){
            return '编辑失败';
        }
        return true;
    }
}