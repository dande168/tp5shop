<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/8 0008
 * Time: 11:27
 */

namespace app\common\model;


use app\admin\validate\Brand as BrandValidate;

class Brand extends Base
{
    //开启自动写入更新时间和创建时间
    protected $autoWriteTimestamp = true;

    /**
     * 添加
     * @return array|bool|string
     */
    public function addData(){
        //获取非图片数据
        $dt = input('post.');
        //获取图片的数据
        $file = input('file.logo');

        //判断是否上传图片
        if(empty($file)){
            return '请上传图片';
        }

        //进行参数验证
        $validate = new BrandValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }

        //上传图片
        $img = $this->uploadOne('logo');

        //当上传图片有错误时，返回错误
        if($img['status'] == 1){
            //当上传图片没有错误时，将图片路径放到$dt['logo']
            $dt['logo'] = $img['img_msg'];
        }else{
            return $img['img_msg'];
        }


        $res = $this->save($dt);
        if(!$res){
            return '添加失败';
        }

        return true;
    }

    /**
     * 查询
     * @return \think\Paginator
     */
    public function sel(){
        $where = [];
        /**********品牌名称*************/
        $brand_name = input('param.brand_name');
        if(!empty($brand_name)){
            $where['brand_name'] = ['=',$brand_name];
        }
        $res = self::where($where)->order('orders desc')->paginate(5);
        return $res;
    }

    public function editData(){
        //获取非图片数据
        $dt = input('post.');
        //获取图片的数据
        $file = input('file.logo');

        //判断是否上传图片   如果不为空，表示上传了图片
        if(!empty($file)){
            //上传图片
            $img = $this->uploadOne('logo');
            //当上传图片有错误时，返回错误
            if($img['status'] == 1){
                //当上传图片没有错误时，将图片路径放到$dt['logo']
                $dt['logo'] = $img['img_msg'];
            }else{
                return $img['img_msg'];
            }
        }

        //进行参数验证
        $validate = new BrandValidate();
        if(!$validate->check($dt)){
            return $validate->getError();
        }

        //更新品牌信息，只允许更新数据库中存在的字段
        $res = $this->allowField(true)->save($dt,['id'=>$dt['id']]);
        if(!$res){
            return '添加失败';
        }
        //当新提交的图片不为空时，将老图片删除   '.'.$dt['old_logo']  拼接为./uploads/....
        if(!empty($dt['logo'])){
            @unlink('.'.$dt['old_logo']);
        }

        return true;
    }

}